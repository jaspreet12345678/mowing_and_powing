<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\User;
use App\Models\Proposal;
use App\Models\Order;
use App\Models\EmailTemplate;
use App\Models\Rating;
use App\Models\ProviderDetail;
use App\Models\ProviderPortfolio;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppLogin;
use App\Models\ProviderLicenseImage;
use App\Models\InsuranceInformationImage;
use App\Models\Wallet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Hash;
use App\Traits\OrderTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Requests\Signup;
use App\Mail\EmailVerification;
use App\Models\BankDetail;

class ProvidersController extends AdminBaseController
{
    use OrderTrait;
    public function index()
    {

        $this->active_providers = User::where('type', 'provider')->where('status', 1)->count();
        $this->pending_providers = User::where('type', 'provider')->where('status', 2)->count();
        $this->block_providers = User::where('type', 'provider')->where('status', 3)->count();
        return view('admin.users.providers.index', $this->data);
    }

    //View Page For Add New Provider
    public function addNewProvider(){
        return view('admin.users.providers.create');
        // return view('admin.users.providers.signup_setp1');
    }


     //First Step of SignUp User
     public function signUp(Request $req)
     {
        try {
            $validator = Validator::make($req->all(), [
                'email' => 'required|email',
                'phone_number' => 'required'
            ]);

            if ($validator->fails()) {return back()->withErrors($validator)->withInput();}

            $userWithPhoneNumber = User::where('phone_number',$req->phone_number)->first();

            if($userWithPhoneNumber && $userWithPhoneNumber->phone_number_verified_at && $userWithPhoneNumber->password) {
                return back()->with('error','Phone number has been taken');
            } elseif ($userWithPhoneNumber && $userWithPhoneNumber->status == 2) {
                $userWithPhoneNumber->delete();
            }

            $userWithEmail = User::where('email',$req->email)->first();

            if($userWithEmail && $userWithEmail->email_verified_at && $userWithEmail->password ) {
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
            return redirect(route('admin.users.provider.verify-email'))->with('email',$req->email);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"Something unexpected happened on server. ".$th->getMessage());
        }
     }

     //Show Page for email verification
     public function verifyEmailIndex()
     {

         if(!session('email')) return redirect(route('admin.users.add_new_provider'));
         return view('admin.users.providers.verify-email',['email' => session('email')]);
     }

     //Verification of email
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
                 return redirect(route('admin.users.provider.verify-phone-number'))->with(['success'=>'Email has been verified. Now kindly verify phone number','phone_number'=>$user->phone_number,'email'=>$req->email]);
             }

         } catch (\Throwable $th) {
             return redirect()->back()->with('error',"Something unexpected happened on server. ".$th->getMessage());
         }
     }

     //Show Page For Phone Verifications
     public function verifyPhoneNumberIndex()
     {
         if(!session('phone_number') || !session('email')) return redirect(route('admin.users.add_new_provider'));
         return view('admin.users.providers.verify-phone-number',['phone_number' => session('phone_number'),'email' => session('email')]);
     }

     //vierfication phone number
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
             return redirect(route('admin.users.provider.register-provider'))->with(['success'=>'Phone number has been verified. Now kindly create your account','email'=>$user->email]);
         }
     }

     //Show Detail page for create provider
     public function registerNewProvider(){
     return view('admin.users.providers.create',['email' => session('email')]);
    }


    //Resend Code for email or phoen number on click
    public function resendCode(Request $req)
    {

        try {
            if($req->resend_for === 'email'){
             $user = User::where('email',$req->email)->first();
            } elseif ($req->resend_for === 'phone_number') {
                $user = User::where('phone_number',$req->phone_number)->first();
            }
             $otp = rand(111111,999999);
            $user->otp = $otp;
            $user->save();

            if($req->resend_for === 'email'){
                 Mail::to($req->email)->send(new EmailVerification($user->first_name, $otp));
                // Log::info('Code resent. Your verification code for email verification is '.$otp);
            } elseif ($req->resend_for === 'phone_number') {
                $this->sendSms($user->phone_number,'This is your 6 digit code '.$otp);
            }

            return response()->json(['success' => true,'message' => 'New verification code has been sent']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false,'message' => 'Something unexpected happened on server. '.$th->getMessage()]);
        }
    }



    //Sned Email  To every provider on click sendEmail bUttons
    public function sendEmailToSingleProvider($id)
    {
       $user_detail=User::where('type', 'provider')->where('id',$id)->first();
       $template = EmailTemplate::where('email_type','app_login')->first();
       $companyName = CompanySetting::first()->name;
       $url = route('web.login');
       $data['password'] = $user_detail->default_password;
       Mail::to($user_detail->email)->send(new AppLogin($user_detail->name,$url,$companyName,$user_detail->email,$data['password'],$template->content));
       return redirect()->back()->with('success', 'Email Send Successfully!');
    }

    //Store New Provider
    public function Store(Request $req){
        $req->validate([
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|max:10',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|confirmed',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'company_name'=>'required',
            'company_size'=>'required',
            'industry_type'=>'required',
            'company_address'=>'required',
            'company_lat'=>'required',
            'company_lang'=>'required',
        ]);

        $req['phone_number'] = "+1".$req->phone_number;

           $check_phone = User::where('phone_number',$req->phone_number)->first();
           if(!empty($check_phone)){
            return back()->with('error','Phone Number Already Exist');
           }
           $user=new User();
            $user->email=$req->email;
            $user->phone_number=$req->phone_number;
             $user->first_name = $req->first_name;
             $user->last_name = $req->last_name;
             $user->password= Hash::make($req->password);
             $user->default_password=$req->password;
             $user->type = 'provider';
             $user->address = $req->address;
             $user->phone_number_verified_at=now();
             $user->email_verified_at=now();
             $user->lat = $req->lat;
             $user->lng = $req->lng;
             $user->status = 2;


        if ($req->profile_pic) {
            $foldername = '/uploads/clients/profile pics/';
            $filename = time() . '-' . rand(0000000, 9999999) . '.' . $req->file('profile_pic')->extension();
            $req->file('profile_pic')->move(public_path() . $foldername, $filename);
            $user->image = $foldername.$filename;
        }
         $user->referral_link = "/referral-link/" . Str::random(16);
         $user->save();

         if ($req->refferal_link) {
            $referred_by = User::where('referral_link',$req->refferal_link)->first();
           if (!$referred_by) return redirect()->back()->with('error', "This referral link does not exist.");
           $user->referred_by = $referred_by->id;
           $user->save();
           Wallet::whereUserId($referred_by->id)->first()->increment('amount', settings('referral_bonus'));
           sendNotification(
               $referred_by->id,
               $user->id,
               'Congratulations on bonus',
               "You have been awarded a bonus for referring a friend @ Mowing and Plowing"
           );
       }


        ProviderDetail::create([
          'provider_id'=>$user->id,
          'company_name'=>$req->company_name,
          'company_size'=>$req->company_size,
          'industry_type'=>$req->industry_type,
          'company_website'=>$req->company_website,
          'company_address'=>$req->company_address,
          'lat'=>$req->company_lat,
          'lng'=>$req->company_lang
        ]);


        foreach($req->protfolio_images as $protfolioimages){
            $foldername = '/uploads/providers/protfilio/';
            $filename = time() . '-' . rand(00000, 99999) . '.' . $protfolioimages->extension();
            $protfolioimages->move(public_path() . $foldername, $filename);
            ProviderPortfolio::create(['provider_id' => $user->id, 'image' => $foldername . $filename]);
        }

        foreach($req->license_images as $licenseimages){
            $foldername = '/uploads/providers/license pics/provider-id-'.$user->id. '/';
            $filename = time() . '-' . rand(00000, 99999) . '.' . $licenseimages->extension();
            $licenseimages->move(public_path() . $foldername, $filename);
            ProviderLicenseImage::create(['provider_id' => $user->id, 'license_image' => $foldername . $filename]);
        }

        foreach($req->insurance_images as $insuranceimages){
            $foldername = '/uploads/providers/insurance pic/provider-id-'.$user->id. '/';
            $filename = time() . '-' . rand(00000, 99999) . '.' . $insuranceimages->extension();
            $insuranceimages->move(public_path() . $foldername, $filename);
            InsuranceInformationImage::create(['provider_id' => $user->id, 'image' => $foldername . $filename]);
        }

        return redirect()->route('admin.users.providers.index')->with('success',"Provider has been addedd Successfully!");

    }

    //Show Penidng providers list
    public function pendingProviders(Request $request)
    {
        $this->active_providers = User::where('type', 'provider')->where('status', 1)->count();
        $this->pending_providers = User::where('type', 'provider')->where('status', 2)->count();
        $this->block_providers = User::where('type', 'provider')->where('status', 3)->count();
        if ($request->expectsJson()) {
            return Datatables::of(User::where('type', 'provider')->where('status', 2)->orderBy('id'))->make();
        }
        return view('admin.users.providers.pending', $this->data);
    }

    //show Bloakc provider list
    public function blockProviders(Request $request)
    {
        $this->active_providers = User::where('type', 'provider')->where('status', 1)->count();
        $this->pending_providers = User::where('type', 'provider')->where('status', 2)->count();
        $this->block_providers = User::where('type', 'provider')->where('status', 3)->count();
        if ($request->expectsJson()) {
            return Datatables::of(User::where('type', 'provider')->where('status', 3)->orderBy('id'))->make();
        }
        return view('admin.users.providers.block', $this->data);
    }

    //Delete providers
    public function destroy($id)
    {
        try {

            User::find($id)->delete();
            session()->flash('success', 'Provider deleted successfully');
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong! Admin can not be deleted', 'error' => $th->getMessage()]);
        }
    }

    //Block User
    public function blockUser($id)
    {
        try {

            User::where('id', $id)->update(['status' => 3]);
            return redirect()->back()->with('success', 'Provider Block Successfully!');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong! Admin can not be deleted', 'error' => $th->getMessage()]);
        }
    }

    //Active User
    public function activeUser($id)
    {
        try {
            User::where('id', $id)->update(['status' => 1]);
            return redirect()->back()->with('success', 'Provider Activate Successfully!');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong! Admin can not be deleted', 'error' => $th->getMessage()]);
        }
    }

    //Show data on index page throuhh ajax
    public function data(Request $request)
    {
        if ($request->expectsJson()) {
            return Datatables::of(User::where('type', 'provider')->where('status', 1)->orderBy('id'))->make();
        }
        return view('admin.users.providers.index', $this->data);
    }

  //Show User Detail against id
    public function showUserDetail(Request $req, $id)
    {

        $this->customer = User::find($id);
        $this->order_detail = Order::where('assigned_to', $this->customer->id)->get();

        if ($req->proposal_id) {
            $proposal = Proposal::find($req->proposal_id);
            if (!$proposal) return back()->with('error', "Proposal does not exist");
            $order = Order::whereUserId(auth()->id())->whereId($proposal->order_id)->first();
            if (!$order) return back()->with('error', "You do not have access to this proposal");
        }

        $this->provider = User::find($id);
        $this->type = $req->type ?? 'details';
        $this->proposal_id = $req->proposal_id ?? 0;
        $this->calculateAllRatings($id);
        $this->bankAccounts = BankDetail::whereProviderId($id)->latest()->get();

        return view('admin.users.providers.show',$this->data);
    }


    public function calculateAllRatings($provider_id)
    {
        $this->totalScore = 0;
        $this->qualityRatingPerc = 0;
        $this->responseOnTimePerc = 0;
        $this->completeJobsPerc = 0;
        $this->cancelJobsPerc = 0;
        $totalRatingsCount = Rating::whereProviderId($provider_id)->count();
        $totalJobs = Order::whereAssignedTo($provider_id)->wherePaymentStatus(2)->whereIn('status', [2, 3, 4])->count();

        if ($totalRatingsCount) {
            $sumOfQualityRatings = Rating::whereProviderId($provider_id)->sum('quality_rating');
            $qualityRating = $sumOfQualityRatings / $totalRatingsCount;

            $sumOfResponseOnTimeRatings = Rating::whereProviderId($provider_id)->sum('response_time_rating');
            $responseOnTimeRating = $sumOfResponseOnTimeRatings / $totalRatingsCount;

            $this->responseOnTimePerc = ($responseOnTimeRating / 5) * 100;
            $this->qualityRatingPerc = ($qualityRating / 5) * 100;
            $this->totalScore = ($this->responseOnTimePerc + $this->qualityRatingPerc) / 2;
        }

        if ($totalJobs) {
            $completedJobs = Order::whereAssignedTo($provider_id)->wherePaymentStatus(2)->whereStatus(3)->latest()->count();
            $this->completeJobsPerc = ($completedJobs / $totalJobs) * 100;

            $canceledJobs = Order::whereAssignedTo($provider_id)->wherePaymentStatus(2)->whereStatus(4)->latest()->count();
            $this->cancelJobsPerc = ($canceledJobs / $totalJobs) * 100;
        }
    }
}
