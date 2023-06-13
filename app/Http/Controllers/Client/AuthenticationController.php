<?php

namespace App\Http\Controllers\Client;
use App\Http\Requests\Signup;
use App\Mail\EmailVerification;
use App\Models\Admin;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\OrderTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\City;
use App\Models\CityList;
class AuthenticationController extends ClientBaseController
{
    use OrderTrait;

    public function signupIndex(Request $req)
    {
        return view('client.auth.signup',$this->data);
    }

    public function homePage(){
        $sekected_city = City::all()->pluck('name');
        $city_list = CityList::whereIn('ID',$sekected_city)->with('state')->get();
        return view('homepage',compact('city_list'));
    }

    public function signup(Request $req)
    {
        try {

            $validator = Validator::make($req->all(), [
                'email' => 'required|email',
                'phone_number' => 'required|max:10'
            ]);

            if ($validator->fails()) {return back()->withErrors($validator)->withInput();}

            $req['phone_number'] = "+1".$req->phone_number;

            $userWithPhoneNumber = User::where('phone_number',$req->phone_number)->first();

            if($userWithPhoneNumber && $userWithPhoneNumber->phone_number_verified_at && $userWithPhoneNumber->password) {
                return back()->with('error','Phone number has been taken');
            } elseif ($userWithPhoneNumber && $userWithPhoneNumber->status == 2) {
                $userWithPhoneNumber->delete();
            }

            $userWithEmail = User::where('email',$req->email)->first();

            if($userWithEmail && $userWithEmail->email_verified_at && $userWithEmail->password) {
                return back()->with('error','Email has been taken');
            } elseif ($userWithEmail && $userWithEmail->status == 2) {
                $userWithEmail->delete();
            }

            $user = User::create([
                'email' => $req->email,
                'phone_number' => $req->phone_number,
                'type' => 'customer',
            ]);
             $otp = rand(111111,999999);
            $user->otp = $otp;
            $user->save();

            Mail::to($req->email)->send(new EmailVerification('Sir/Madam',$otp));

            return redirect(route('verify-email'))->with('email',$req->email);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"Something unexpected happened on server. ".$th->getMessage());
        }
    }

    public function verifyEmailIndex()
    {
        if(!session('email')) return redirect(route('web.login'));
        return view('client.auth.verify-email',['email' => session('email')]);
    }

    public function verifyEmail(Request $req)
    {
        try {
            $data = $req->except('_token');
            $otp = '';
            foreach($data['otp'] as $key=>$value) {$otp .= $value;};
            $user = User::where('email',$req->email)->first();

            if($otp != $user->otp){
                return redirect()->back()->with(['email'=>$req->email,'error'=>"Your verification code is not correct"]);
            } else {
                $user->email_verified_at = now();
                  $otp = rand(111111,999999);
                $user->otp = $otp;
                $user->save();

                $this->sendSms($user->phone_number,'This is your 6 digit code '.$otp);

                return redirect(route('verify-phone-number'))->with(['success'=>'Email has been verified. Now kindly verify phone number','phone_number'=>$user->phone_number,'email'=>$req->email]);
            }

        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"Something unexpected happened on server. ".$th->getMessage());
        }
    }

    public function verifyPhoneNumberIndex()
    {
        if(!session('phone_number') || !session('email')) return redirect(route('signup'));
        return view('client.auth.verify-phone-number',['phone_number' => session('phone_number'),'email' => session('email')]);
    }

    public function verifyPhoneNumber(Request $req)
    {
        $data = $req->except('_token');
        $otp = '';
        foreach($data['otp'] as $key=>$value) {$otp .= $value;};
        $user = User::where('email',$req->email)->first();

        if($otp != $user->otp){
            return redirect()->back()->with(['email'=>$user->email,'phone_number'=>$user->phone_number,'error'=>"Your verification code is not correct"]);
        } else {
            $user->phone_number_verified_at = now();
            $user->otp = null;
            $user->save();
            return redirect(route('registration'))->with(['success'=>'Phone number has been verified. Now kindly create your account','email'=>$user->email]);
        }
    }

    public function registrationIndex()
    {
        if(session('email')) return view('client.auth.registration',['email' => session('email')]);
        return redirect(route('signup'));
    }

    public function registration(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'email' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'password' => 'required|confirmed',
                'image' => 'mimes:jpg,jpeg,png',
                'address' => 'required',
                'lat' => 'required',
                'lng' => 'required',
            ]);
            if ($validator->fails()) {return back()->withInput()->with(['email' => $req->email,'errors' => $validator->errors()]);}

            $user = User::where('email',$req->email)->first();

            if(!$user) {return back()->with('error','Account does not exist with this email');}

            $user->first_name = $req->first_name;
            $user->last_name = $req->last_name;
            $user->password = Hash::make($req->password);
            $user->address = $req->address;
            $user->lat = $req->lat;
            $user->lng = $req->lng;
            $user->referral_link = "/referral-link/". Str::random(16);
            $user->status = 1;

            if($req->image){
                $foldername = '/uploads/clients/profile pics/';
                $filename = time().'-'.rand(0000000,9999999).'.'.$req->file('image')->extension();
                $req->file('image')->move(public_path().$foldername,$filename);
                $user->image = $foldername.$filename;
            }

            $user->customer_id = $this->stripe->customers->create([
                'name' => $user->first_name.' '.$user->last_name,
                'email' => $user->email,
            ])->id;

            $user->save();

            Wallet::create(['user_id'=>$user->id]);

            if($req->referral_link){
                $referred_by = User::whereReferralLink(substr($req->referral_link,-31))->first();
                if(!$referred_by) return redirect()->back()->with('error',"This referral link does not exist.");

                $user->referred_by = $referred_by->id;
                $user->save();

                Wallet::whereUserId($referred_by->id)->first()->increment('amount',settings('referral_bonus'));

                sendNotification(
                    $referred_by->id,
                    $user->id,
                    'Congratulations on bonus',
                    "You have been awarded a bonus for referring a friend @ Mowing and Plowing"
                );
            }

            Auth::login($user);

            return redirect()->route('dashboard')->with('success',"Welcome to Mowing and Plowing");

        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"Something unexpected happened on server. ".$th->getMessage());
        }
    }


    public function resendCode(Request $req)
    {
        try {
            if($req->resend_for === 'email'){
                $user = User::where('email',$req->email)->first();
            } elseif ($req->resend_for === 'admin-email') {
                $user = Admin::where('email',$req->email)->first();
            } elseif ($req->resend_for === 'phone_number') {
                $user = User::where('phone_number',$req->phone_number)->first();
            }
            $otp = rand(111111,999999);
            $user->otp = $otp;
            $user->save();

            if($req->resend_for === 'email' || $req->resend_for === 'admin-email'){
                Mail::to($req->email)->send(new EmailVerification($user->first_name, $otp));
            } elseif ($req->resend_for === 'phone_number') {
                $this->sendSms($user->phone_number,'This is your 6 digit code '.$otp);
            }

            return response()->json(['success' => true,'message' => 'New verification code has been sent']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false,'message' => 'Something unexpected happened on server. '.$th->getMessage()]);
        }
    }

    // Login Index
    public function loginIndex(Request $req)
    {
        if(Auth::check()) return redirect(route('dashboard'));

        return view('client.auth.login');
    }

    // Login
    public function login(Request $request)
    {
        $additionalVar = $request->input('additionalVar1'); 
        

        if(!Auth::attempt(
            ['email' => $request->email,'password' => $request->password,'status' => 1,'type' => 'customer'],
            $request->remember_me == 'on' ? true : false
        )){
            
            if(!empty($additionalVar)){
                return json_encode(array('success'=>false,'message'=>"Email or password is not correct or your account is not active"));
            }else{
                return redirect()->back()->with('error','Email or password is not correct or your account is not active');
            }
        }

        User::find(auth()->id())->update([
            'last_login_device' => 'web',
            'default_password' => null,
        ]);

        if(!empty($additionalVar)){
            return json_encode(array('success'=>true,'message'=>"Login Suceexfully"));
        }else{
            return redirect(route('dashboard'));
        }
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect(route('web.login'));
    }

    public function editProfile()
    {
        return view('client.auth.edit-profile');
    }

    public function updateProfile(Request $req)
    {

        $req->validate([
            'email'=>'required|max:255',
            'phone_number'=>'required|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'address' => 'required',
        ]);

        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $foldername = '/uploads/customer/profile_pic/';
            $filename = time() . '-' . rand(00000, 99999) . '.' . $image->extension();
            $image->move(public_path() . $foldername, $filename);
            User::where('email', $req->email)->update(['image' => $foldername . $filename]);
        }
        if ($req->password) {
            $req->validate([
                'password' => 'confirmed',
            ]);
            $customer_data['password'] = hash::make($req->password);
        }

        $customer_data = [
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'address' => $req->address,
        ];
        User::where('email', $req->email)->update($customer_data);

        // $data = $req->except('_token');
        // User::updateOrCreate(['email' => $data['email']],$data);

        return back()->with('success','Profile updated');
    }

    public function resetPasswordEmail(Request $req)
    {
        return view('client.auth.reset-password-email');
    }

    public function verifyResetPasswordEmailIndex(Request $req)
    {
        $email = $req->email;
        $user = User::whereEmail($req->email)->first();

        if(!$user->otp) {
              $otp = rand(111111,999999);
            $user->otp = $otp;
            $user->save();

            Mail::to($req->email)->send(new EmailVerification('Sir/Madam',$otp));
        }

        return view('client.auth.verify-reset-password-email',compact('email'));
    }


    public function verifyResetPasswordEmail(Request $req)
    {
        try {
            $data = $req->except('_token');
            $otp = '';
            foreach($data['otp'] as $key=>$value) {$otp .= $value;};
            $user = User::where('email',$req->email)->first();

            if($otp != $user->otp){
                return redirect()->back()->with(['error'=>"Your verification code is not correct"]);
            } else {
                $user->otp = null;
                $user->save();
                return redirect(route('forget-password.reset-password.index'))->with('email',$req->email);
            }

        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"Something unexpected happened on server. ".$th->getMessage());
        }
    }

    public function resetPasswordIndex(Request $req)
    {
        if(!session('email')) return redirect(route('web.login'));
        return view('client.auth.reset-password',['email' => session('email')]);
    }

    public function resetPassword(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'password' => 'required|confirmed',
        ]);
        if ($validator->fails()) {return back()->with(['errors'=>$validator->errors(),'email'=>$req->email]);}

        $user = User::where('email',$req->email)->first();
        $user->password = Hash::make($req->password);
        $user->save();

        return redirect(route('web.login'))->with('success',"Password reset successfully");
    }

    public function authCheck()
    {
        return response()->json(['authenticated' => auth()->check()]);
    }

    public function deleteAccount(Request $req)
    {
        try {
            $user = User::find(auth()->id());
            $user->email = $user->email."-account-deleted-".rand(1111111,9999999);
            $user->phone_number = $user->phone_number."-account-deleted-".rand(1111111,9999999);
            $user->google_id = null;
            $user->status = 3;
            $user->save();

            Auth::logout();

            return redirect(route('web.login'))->with('Your account has been deleted');
        } catch (\Throwable $th) {
            return redirect()->back()->with("Something unexpected happened on server. " . $th->getMessage());
        }
    }
}
