<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthenticationController extends AdminBaseController
{

    // Login Index
    public function loginIndex()
    {

        if(Auth::guard('admin')->check()){return redirect(route('admin.dashboard.index'));}

        return view('admin.auth.login', $this->data);
    }

    // Login
    public function login(Request $request)
    {

        if(!Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password,'status'=>1])){
            return redirect()->back()->with('error','Email or password is not correct or your account is not active');
        }

        return redirect(route('admin.dashboard.index'));
    }

    // Logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }

    public function resetPasswordEmail(Request $req)
    {
        return view('admin.auth.reset-password-email');
    }

    public function verifyResetPasswordEmailIndex(Request $req)
    {
        $email = $req->email;
        $user = Admin::whereEmail($req->email)->first();

        if(!$user->otp) {
            $otp = rand(111111,999999);
            $user->otp = $otp;
            $user->save();

            Mail::to($req->email)->send(new EmailVerification('Sir/Madam',$otp));
        }

        return view('admin.auth.verify-reset-password-email',compact('email'));
    }


    public function verifyResetPasswordEmail(Request $req)
    {
        try {
            $data = $req->except('_token');
            $otp = '';
            foreach($data['otp'] as $key=>$value) {$otp .= $value;};
            $user = Admin::where('email',$req->email)->first();

            if($otp != $user->otp){
                return redirect()->back()->with(['error'=>"Your verification code is not correct"]);
            } else {
                $user->otp = null;
                $user->save();
                return redirect(route('admin.forget-password.reset-password.index'))->with('email',$req->email);
            }

        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"Something unexpected happened on server. ".$th->getMessage());
        }
    }

    public function resetPasswordIndex(Request $req)
    {
        if(!session('email')) return redirect(route('admin.login'));
        return view('admin.auth.reset-password',['email' => session('email')]);
    }

    public function resetPassword(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'password' => 'required|confirmed',
        ]);
        if ($validator->fails()) {return back()->with(['errors'=>$validator->errors(),'email'=>$req->email]);}

        $user = Admin::where('email',$req->email)->first();
        $user->password = Hash::make($req->password);
        $user->save();

        return redirect(route('admin.login'))->with('success',"Password reset successfully");
    }

}
