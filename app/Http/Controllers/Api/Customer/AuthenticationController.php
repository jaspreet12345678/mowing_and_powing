<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Card;
use App\Models\Order;
use App\Models\FavoriteProvider;
use App\Models\Notification;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Type\NullType;
use Illuminate\Support\Str;
use App\Traits\OrderTrait;

class AuthenticationController extends ApiBaseController
{
    use OrderTrait;

    public function verifyEmailAndPhoneNumber(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'email' => 'required|email',
                'phone_number' => 'required'
            ]);
            if ($validator->fails()) {
                return parent::resp(false, 'Validation errors', null, $validator->errors());
            }

            $user = User::where('phone_number', $req->phone_number)->first();
            if ($user && $user->phone_number_verified_at && $user->password) {
                return parent::resp(false, 'There is already a taker for this phone number');
            }

            if (!$user) {
                $user = new User();
                $user->phone_number = $req->phone_number;
                $user->type = 'customer';
                $user->lat = '40.5252';
                $user->lng = '-41.55646';
            }

            $user->unverified_email = $req->email;
            $user->save();

            $this->sendOtpAndMeassage($user);

            return parent::resp(true, 'Your phone number has received an OTP; please confirm', $req->phone_number);
        } catch (\Throwable $th) {
            return parent::resp(false, "On the server, an unforeseen event occurred" . $th->getMessage());
        }
    }

    public function phoneNumberVerification(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'phone_number' => 'required',
                'otp' => 'required',
            ]);
            if ($validator->fails()) {
                return parent::resp(false, 'Validation errors', null, $validator->errors());
            }

            $user = User::where('phone_number', $req->phone_number)->first();
            if (!$user) {
                return parent::resp(false, 'This phone number is not associated with any accounts');
            }

            $response = $this->matchOTP($user, $req->otp, null, 'phone_number');

            return parent::resp($response['success'], $response['message']);
        } catch (\Throwable $th) {
            return parent::resp(false, "On the server, an unforeseen event occurred" . $th->getMessage());
        }
    }

    public function addProfileDetail(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'phone_number' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'password' => 'required|confirmed',
                'image' => 'mimes:jpg,jpeg,png',
                'country_code' => 'required',
                'address' => 'required',
                'zip_code' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ]);
            if ($validator->fails()) {
                return parent::resp(false, 'Validation errors', null, $validator->errors());
            }

            $user = User::where('phone_number', $req->phone_number)->first();

            if (!$user) {
                return parent::resp(false, 'This phone number is not associated with any accounts');
            }

            $user->first_name = $req->first_name;
            $user->last_name = $req->last_name;
            $user->password = hash::make($req->password);
            $user->address = $req->address;
            $user->zip_code = $req->zip_code;
            $user->lat = $req->latitude;
            $user->lng = $req->longitude;
            $user->created_by = $req->created_by ?? Null;

            if ($req->image) {
                $foldername = '/uploads/clients/profile pics/';
                $filename = time() . '-' . rand(0000000, 9999999) . '.' . $req->file('image')->extension();
                $req->file('image')->move(public_path() . $foldername, $filename);
                $user->image = $foldername . $filename;
            }

            $user->customer_id = $this->stripe->customers->create([
                'name' => $user->first_name . ' ' . $user->last_name,
                'phone' => $user->phone_number,
                'address' => [
                    'country' => $req->country_code
                ],
            ])->id;

            $user->referral_link = "/referral-link/" . Str::random(16);
            $user->status = 1;
            $user->save();

            Wallet::create(['user_id' => $user->id]);

            if ($req->referral_link) {
                $referred_by = User::whereReferral_link(substr($req->referral_link, -31))->first();
                if (!$referred_by) {
                    return parent::resp(false, 'This referral link does not exist.');
                }

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

            if ($user->created_by) {
                $provider = User::whereId($user->created_by)->select(['id', 'first_name', 'last_name'])->first();
                $message = 'Your account has been created by ' . $provider->first_name . " " . $provider->last_name . " (Provider)";

                sendNotification(
                    $user->id,
                    $provider->id,
                    'Welcome to Mowing and Plowing',
                    $message
                );

                $this->sendSms($user->phone_number, $message);
            }

            // Login after signup
            $this->user = $user;
            $this->user->last_login_device = 'mobile';
            $this->user->default_password = null;
            $this->user->save();

            $this->token = $this->user->createToken('login');
            $this->cards = Card::whereUserId($this->user->id)->select(['id', 'last4', 'is_default', 'card_id'])->get();
            $this->wallet = Wallet::whereUserId($this->user->id)->first();
            $this->autoRefillLimit = settings('auto_refill_limit');
            $this->unreadNotificationsCount = Notification::whereReceiverId($this->user->id)->whereStatus("0")->count();

            return parent::resp(true, 'You have logged in successfully', $this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "On the server, an unforeseen event occurred" . $th->getMessage());
        }
    }

    public function login(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'phone_number' => 'required',
                'password' => 'required',
                'user_type' => 'required',
            ]);
            if ($validator->fails()) {
                return parent::resp(false, 'Validation errors', null, $validator->errors());
            }

            $this->user = User::wherePhoneNumber($req->phone_number)->whereIn('status', [1, 2])->whereType($req->user_type)->first();

            if (!$this->user) {
                return parent::resp(false, 'This phone number has never been connected to any accounts or account is not active.');
            }
            if (!Hash::check($req->password, $this->user->password)) {
                return parent::resp(false, 'Please enter the correct password');
            }

            $this->user->last_login_device = 'mobile';
            $this->user->default_password = null;
            $this->user->save();
            $this->token = $this->user->createToken('login');

            if ($this->user->type == 'customer') {
                $this->cards = Card::whereUserId($this->user->id)->select(['id', 'last4', 'is_default', 'card_id'])->get();
                $this->wallet = Wallet::whereUserId($this->user->id)->first();
                $this->autoRefillLimit = settings('auto_refill_limit');
                $this->unreadNotificationsCount = Notification::whereReceiverId($this->user->id)->whereStatus("0")->count();
            }

            return parent::resp(true, 'You have logged in successfully', $this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "On the server, an unforeseen event occurred" . $th->getMessage());
        }
    }

    public function getDataLikeLogin()
    {
        try {
            $this->user = auth()->user();
            if ($this->user->type == 'customer') {
                $this->cards = Card::whereUserId($this->user->id)->select(['id', 'last4', 'is_default', 'card_id'])->get();
                $this->wallet = Wallet::whereUserId($this->user->id)->first();
                $this->autoRefillLimit = settings('auto_refill_limit');
            }

            return parent::resp(true, 'You have logged in successfully', $this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "On the server, an unforeseen event occurred" . $th->getMessage());
        }
    }

    public function editProfileDetail(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'address' => 'required',
                'zip_code' => 'required',
                'lat' => 'required',
                'lng' => 'required',
            ]);
            if ($validator->fails()) {
                return parent::resp(false, 'Validation errors', null, $validator->errors());
            }

            $user = User::find(auth()->id());
            $user->update($req->except('email', 'image'));

            if ($req->image) {
                $foldername = '/uploads/clients/profile pics/';
                $filename = time() . '-' . rand(0000000, 9999999) . '.' . $req->file('image')->extension();
                $req->file('image')->move(public_path() . $foldername, $filename);
                $user->image = $foldername . $filename;
                $user->update();
            }

            if ($user->type == 'customer') {
                $this->stripe->customers->update(
                    $user->customer_id,
                    [
                        'name' => $user->first_name . ' ' . $user->last_name,
                    ]
                );
            }

            return parent::resp(true, 'Profile detail has been updated successfully.', $user);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function emailVerificationIndex(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), ['email' => 'required|email',]);
            if ($validator->fails()) {
                return parent::resp(false, 'Validation errors', null, $validator->errors());
            }

            $user = User::find(auth()->id());

            $anotherUser = User::where('email', $req->email)->first();

            if ($anotherUser && $anotherUser->password) {
                return parent::resp(false, "This email has already been taken.");
            }

            $this->sendOtpAndMail($user, $req->email);

            $user->unverified_email = $req->email;
            $user->save();

            return parent::resp(true, '6 digit code has been sent for email verification.', $req->email);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function emailVerification(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'email' => 'required|email',
                'otp' => 'required',
            ]);
            if ($validator->fails()) {
                return parent::resp(false, 'Validation errors', null, $validator->errors());
            }

            $user = User::find(auth()->id());
            if (!$user || $user->unverified_email != $req->email) {
                return parent::resp(false, 'Account does not exist with this unverified email');
            }

            $anotherUser = User::where('email', $req->email)->first();

            if ($anotherUser && $anotherUser->password) {
                return parent::resp(false, "This email has already been taken.");
            }

            $response = $this->matchOTP($user, $req->otp, NULL, 'email');

            if ($response['success']) {
                if ($anotherUser) {
                    $anotherUser->delete();
                }

                $user->email = $req->email;
                $user->unverified_email = null;
                $user->save();

                if ($user->type == 'customer') {
                    $this->stripe->customers->update(
                        $user->customer_id,
                        ['email' => $user->email]
                    );
                }
            }

            return parent::resp($response['success'], $response['message'], $user);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function editPassword(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'current_password' => 'required',
                'password' => 'required|confirmed'
            ]);
            if ($validator->fails()) {
                return parent::resp(false, 'Validation errors', null, $validator->errors());
            }

            $user = User::find(auth()->id());
            if (!$user || !Hash::check($req->current_password, $user->password)) {
                return parent::resp(false, 'Current Password is not correct');
            }

            $user->update(['password' => Hash::make($req->password)]);

            return parent::resp(true, 'Password has been updated successfully.');
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function editEmail(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'current_email' => 'required|email',
                'new_email' => 'required|email',
            ]);
            if ($validator->fails()) {
                return parent::resp(false, 'Validation errors', null, $validator->errors());
            }

            $user = User::find(auth()->id());
            if (!$user || ($req->current_email != $user->email)) {
                return parent::resp(false, "Your current email is not correct.");
            }
            if (!$user || ($user->email === $req->new_email)) {
                return parent::resp(false, "New Email can not be current email.");
            }

            $this->sendOtpAndMail($user, $req->current_email, $req->new_email);

            return parent::resp(true, '6 digit code has been sent for email verification', $req->new_email);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function editEmailVerification(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), ['otp' => 'required',]);
            if ($validator->fails()) {
                return parent::resp(false, 'Validation errors', null, $validator->errors());
            }

            $user = User::find(auth()->id());
            if (!$user) {
                return parent::resp(false, 'Account does not exist with this email');
            }

            $response = $this->matchOTP($user, $req->otp, $user->new_email, 'email');

            if ($response['success'] && $user->type == 'customer') {
                $this->stripe->customers->update(
                    $user->customer_id,
                    ['email' => $user->email,]
                );
            }
            return parent::resp($response['success'], $response['message'], $user);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server." . $th->getMessage());
        }
    }

    public function editPhoneNumber(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'current_phone_number' => 'required',
                'new_phone_number' => 'required',
            ]);
            if ($validator->fails()) {
                return parent::resp(false, 'Validation errors', null, $validator->errors());
            }

            $user = User::find(auth()->id());
            if (!$user || ($req->current_phone_number != $user->phone_number)) {
                return parent::resp(false, "Your current phone number is not correct.");
            }
            if (!$user || ($user->phone_number === $req->new_phone_number)) {
                return parent::resp(false, "New phone number can not be current phone number.");
            }

            $anotherUser = User::where('phone_number', $req->new_phone_number)->first();
            if ($anotherUser && $user->phone_number_verified_at && $user->password) {
                return parent::resp(false, 'There is already a taker for this phone number');
            }

            $this->sendOtpAndMeassage($user, $req->new_phone_number);

            return parent::resp(true, '6 digit code has been sent for phone number verification', $req->new_phone_number);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function editPhoneNumberVerification(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'otp' => 'required',
                'country_code' => 'required',
            ]);
            if ($validator->fails()) {
                return parent::resp(false, 'Validation errors', null, $validator->errors());
            }

            $user = User::find(auth()->id());
            if (!$user) {
                return parent::resp(false, 'Account does not exist with this phone number');
            }

            $response = $this->matchOTP($user, $req->otp, $user->new_phone_number, 'phone_number');
            if ($response['success'] && $user->type == 'customer') {
                $this->stripe->customers->update(
                    $user->customer_id,
                    [
                        'phone' => $user->phone_number,
                        'address' => [
                            'country' => $req->country_code
                        ],
                    ]
                );
            }

            return parent::resp($response['success'], $response['message'], $user);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function sendOtpAndMail($user, $email, $new_email = NULL)
    {

        $otp = rand(111111, 999999);
        $user->otp = $otp;
        $user->new_email = $new_email;
        $user->save();

        Mail::to($new_email ?? $email)->send(new EmailVerification('Sir/Madam', $otp));
    }

    public function sendOtpAndMeassage($user, $new_phone_no = NULL)
    {

        $otp = rand(111111, 999999);
        $user->otp = $otp;
        $user->new_phone_number = $new_phone_no;
        $user->save();

        $this->sendSms($user->phone_number, 'This is your 6 digit code ' . $otp);
    }

    public function matchOTP($user, $otp, $new_content, $type = null)
    {
        if ($otp != $user->otp) {
            return ['success' => false, 'message' => 'The verification code you entered is invalid'];
        } else {
            $user[$type . "_verified_at"] = now();
            $user->otp = null;
            $new_content ? $user->$type = $new_content : '';
            $user["new_" . $type] = null;
            $user->save();
            return ['success' => true,  'message' => 'Your ' . $type . ' has been verified'];
        }
    }

    public function logout(Request $req)
    {
        try {
            $req->user()->currentAccessToken()->delete();

            return parent::resp(true, 'You have logged out successfully.');
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function deleteAccount(Request $req)
    {
        try {
            $user = User::find(auth()->id());
            $user->email = $user->email . "-account-deleted-" . rand(1111111, 9999999);
            $user->phone_number = $user->phone_number . "-account-deleted-" . rand(1111111, 9999999);
            $user->google_id = null;
            $user->status = 3;
            $user->save();

            return parent::resp(true, 'Your account has been deleted');
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }
}
