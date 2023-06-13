<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Traits\OrderTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends ClientBaseController
{
    use OrderTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $userByGoogleId = User::where('google_id', $googleUser->id)->first();
            $userByEmail = User::whereEmail($googleUser->email)->first();

            if($userByGoogleId){
                if($userByGoogleId->status == 1 && $userByGoogleId->type == 'customer') {
                    $userByGoogleId->update([
                        'last_login_device' => 'web',
                        'default_password' => null,
                    ]);
                    Auth::login($userByGoogleId);
                    return redirect()->intended('dashboard');
                } else {
                    throw new Exception("Your account is not active or you are not customer");
                }
            } elseif ($userByEmail) {
                if($userByEmail->status == 1 && $userByEmail->type == 'customer') {
                    $userByEmail->update([
                        'google_id'=> $googleUser->id,
                        'last_login_device' => 'web',
                        'default_password' => null,
                    ]);
                    Auth::login($userByEmail);
                    return redirect()->intended('dashboard');
                } else {
                    throw new Exception("Your account is not active or you are not customer");
                }
            }

            return redirect(route('auth.google.verify-phone-number.index'))->with(['googleUser' => json_encode($googleUser)]);

        } catch (Exception $e) {
            return redirect(route('web.login'))->with('error',$e->getMessage());
        }
    }

    public function verifyPhoneNumberIndex()
    {
        if(!session('googleUser')) return redirect(route('web.login'));
        return view('client.auth.google-signup-registration',['googleUser' => session('googleUser')]);
    }

    public function verifyPhoneNumber(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'phone_number' => 'required|max:10',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'googleUser' => 'required',
        ]);
        if ($validator->fails()) {return back()->withErrors($validator)->withInput();}
        
        $req['phone_number'] = "+1".$req->phone_number;

        $phone_number = $req->phone_number;
        $address = json_encode([
            'address' => $req->address,
            'lat' => $req->lat,
            'lng' => $req->lng,
        ]);
        $googleUser = $req->googleUser;

        $userWithPhoneNumber = User::where('phone_number',$req->phone_number)->first();

        if($userWithPhoneNumber && $userWithPhoneNumber->phone_number_verified_at && $userWithPhoneNumber->password) {
            return redirect()->back()->with(['error'=>'Phone number has been taken','googleUser'=>$googleUser]);
        } elseif ($userWithPhoneNumber && $userWithPhoneNumber->status == 2) {
            $userWithPhoneNumber->delete();
        }

        $user = User::create([
            'phone_number' => $req->phone_number,
            'type' => 'customer',
        ]);
         $otp = rand(111111,999999);
        $user->otp = $otp;
        $user->save();

        $this->sendSms($user->phone_number,'This is your 6 digit code '.$otp);

        return view('client.auth.google-signup-verify-number',compact('googleUser','phone_number','address'));
    }

    public function registerUsingGoogleOauth(Request $req)
    {
        try {
            $googleUser = json_decode($req->googleUser);
            $address = json_decode($req->address);
            $user = User::wherePhoneNumber($req->phone_number)->first();
            $data = $req->except('_token');
            $otp = '';
            foreach($data['otp'] as $key=>$value) {$otp .= $value;};

            if($otp != $user->otp){
                return redirect()->back()->with(['error'=>'Your verification code is not correct'])->withInput();
            }

            $stripe = new \Stripe\StripeClient(config('stripe.TEST_SECRET_KEY'));

            $customer = $stripe->customers->create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
            ]);

            $user->update([
                'customer_id' => $customer->id ?? null,
                'google_id'=> $googleUser->id,
                'first_name' => $googleUser->user->given_name,
                'last_name' => $googleUser->user->family_name,
                'email' => $googleUser->email,
                'password' => Hash::make(rand(000000,999999)),
                'type' => 'customer',
                'last_login_device' => 'web',
                'default_password' => null,
                'status' => '1',
                'address' => $address->address,
                'lat' => $address->lat,
                'lng' => $address->lng,
                'referral_link' => "/referral-link/". Str::random(16),
                'phone_number_verified_at' => now(),
                'email_verified_at' => now(),
                'otp' => null,
            ]);

            \App\Models\Wallet::create(['user_id' => $user->id]);

            Auth::login($user);
            return redirect()->intended('dashboard');

        } catch (Exception $e) {
            return redirect(route('web.login'))->with('error',$e->getMessage());
        }
    }
}
