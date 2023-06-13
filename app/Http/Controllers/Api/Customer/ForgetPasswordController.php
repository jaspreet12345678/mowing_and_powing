<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
use App\Traits\OrderTrait;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordController extends ApiBaseController
{
    use OrderTrait;

    public function sendOtpOnPhoneNumber(Request $request){
        try{
            $validator = Validator::make($request->all(), ['phone_number' => 'required',]);
            if ($validator->fails()) {return parent::resp(false, 'Validation errors', null, $validator->errors());}

            $user = User::where('phone_number', $request->phone_number)->first();
            if(!$user) {return parent::resp(false, 'This phone number is not associated with any accounts');}
            if(!$user->password) {return parent::resp(false, "You haven't already set a password. Please finish creating your profile first");}

            $otp = rand(111111, 999999);
            $user->otp = $otp;
            $user->save();

            $this->sendSms($user->phone_number,$user->otp);

            return parent::resp(true, 'Your phone number has received an OTP; please confirm', $request->email);
        } catch (\Throwable $th) {
            return parent::resp(false, "On the server, an unforeseen event occurred" . $th->getMessage());
        }
    }

    public function resetPassword(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'phone_number' => 'required',
                'otp' => 'required',
            ]);
            if ($validator->fails()) {return parent::resp(false, 'Validation errors', null, $validator->errors());}

            $user = User::where('phone_number', $request->phone_number)->first();
            if (!$user) {return parent::resp(false, 'This phone number is not associated with any accounts');}
            if ($request->otp != $user->otp) { return parent::resp(false, 'Your verification code is not correct');}

            return parent::resp(true, 'A match was made with your OTP. Give a new password now', $user->email);
        } catch (\Throwable $th) {
            return parent::resp(false, "On the server, an unforeseen event occurred" . $th->getMessage());
        }

    }

    public function updatePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone_number' => 'required',
                'password' => 'required|confirmed',
                'otp' => 'required',
            ]);
            if ($validator->fails()) {return parent::resp(false, 'Validation errors', null, $validator->errors());}

            $user = User::where('phone_number', $request->phone_number)->first();
            if ($request->otp != $user->otp) { return parent::resp(false, 'You entered an incorrect verification code');}

            $user->password = Hash::make($request->password);
            $user->otp = null;
            $user->save();

            return parent::resp(true, 'Successfully updated the password');
        } catch (\Throwable $th) {
            return parent::resp(false, "On the server, an unforeseen event occurred" . $th->getMessage());
        }
    }
}
