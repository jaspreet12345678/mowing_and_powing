<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Card;
use App\Models\FavoriteProvider;
use App\Models\InsuranceInformationImage;
use App\Models\ProviderDetail;
use App\Models\ProviderLicenseImage;
use App\Models\ProviderPortfolio;
use App\Traits\OrderTrait;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Type\NullType;
use Illuminate\Support\Str;
use Symfony\Contracts\Service\Attribute\Required;

class AuthenticationController extends ApiBaseController
{

    use OrderTrait;

    public function emailAndPhoneNumber(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'email' => 'required|email',
                'phone_number' => 'required'
            ]);
            if ($validator->fails()) {return parent::resp(false, 'Validation errors', null, $validator->errors());}

            $user = User::where('phone_number', $req->phone_number)->first();
            if ($user && $user->phone_number_verified_at && $user->password) {return parent::resp(false, 'There is already a taker for this phone number.');}

            if (!$user) {
                $user = new User();
                $user->phone_number = $req->phone_number;
                $user->type = 'provider';
                $user->lat = '20.5252';
                $user->lng = '-11.55646';
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
            if ($validator->fails()) {return parent::resp(false, 'Validation errors', null, $validator->errors());}

            $user = User::where('phone_number', $req->phone_number)->first();
            if (!$user) {return parent::resp(false, 'This phone number is not associated with any accounts'); }

            $response = $this->matchOTP($user,$req->otp,null,'phone_number');

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
                'company_name' => 'required',
                'company_size' => 'required',
                'industry_type' => 'required',
                'company_address' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'license_images' => 'required',
                'insurance_images' => 'required',
                'zip_code' => 'required',
            ]);
            if ($validator->fails()) {return parent::resp(false, 'Validation errors', null, $validator->errors());}

            $user = User::wherePhone_number($req->phone_number)->first();
            if (!$user) {return parent::resp(false, 'This phone number is not associated with any accounts');}

            $user->first_name = $req->first_name;
            $user->last_name = $req->last_name;
            $user->password = Hash::make($req->password);
            $user->address = $req->address;
            $user->zip_code = $req->zip_code;
            $user->lat = $req->latitude;
            $user->lng = $req->longitude;

            if ($req->image) {
                $foldername = '/uploads/providers/profile pics/';
                $filename = time() . '-' . rand(0000000, 9999999) . '.' . $req->file('image')->extension();
                $req->file('image')->move(public_path().$foldername, $filename);
                $user->image = $foldername . $filename;
            }

            $user->status = 2;
            $user->save();

            $data['provider_id'] = $user->id;
            $data['company_name'] = $req->company_name;
            $data['company_size'] = $req->company_size;
            $data['industry_type'] = $req->industry_type;
            $data['company_address'] = $req->company_address;
            $data['lat'] = $req->lat;
            $data['lng'] = $req->lng;
            $data['zip_code'] = $req->zip_code;
            $data['company_website'] = $req->company_website;
            $data['last_known_lat'] = $req->latitude;
            $data['last_known_lng'] = $req->longitude;

            ProviderDetail::create($data);

            if ($req->license_images) {
                $images = $req->file('license_images');
                foreach ($images as $image) {
                    $foldername = '/uploads/providers/license pics/provider-id-'.$user->id.'/';
                    $filename = time() . '-' . rand(0000000, 9999999) . '.' . $image->extension();
                    $image->move(public_path().$foldername, $filename);
                    $data['provider_id'] = $user->id;
                    $data['license_image'] = $foldername . $filename;
                }
                ProviderLicenseImage::create($data);
            }

            if ($req->images) {
                $images = $req->file('images');
                foreach ($images as $image) {
                    $foldername = '/uploads/user-portfolio/provider-id-'.$user->id.'/';
                    $filename = time().'-'.rand(00000,99999).'.'.$image->extension();
                    $image->move(public_path().$foldername,$filename);
                    $data['provider_id'] = $user->id;
                    $data['image'] = $foldername.$filename;
                    ProviderPortfolio::create($data);
                }
            }

            if ($req->insurance_images) {
                $images = $req->file('insurance_images');
                foreach ($images as $image) {
                    $foldername = '/uploads/user-insurance-info-images/provider-id-'.$user->id.'/';
                    $filename = time().'-'.rand(00000,99999).'.'.$image->extension();
                    $image->move(public_path().$foldername,$filename);
                    $data['provider_id'] = $user->id;
                    $data['image'] = $foldername.$filename;
                    InsuranceInformationImage::create($data);
                }
            }

            // Login after signup
            $this->user = $user;
            $this->user->last_login_device = 'mobile';
            $this->user->default_password = null;
            $this->user->save();
            $this->token = $this->user->createToken('login');

            return parent::resp(true, 'You have logged in successfully',$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "On the server, an unforeseen event occurred" . $th->getMessage());
        }
    }

    public function sendOtpAndMeassage($user,$new_phone_no = NULL)
    {

        $otp = rand(111111, 999999);
        $user->otp = $otp;
        $user->new_phone_number = $new_phone_no;
        $user->save();

        $this->sendSms($user->phone_number,'This is your 6 digit code '.$otp);
    }

    public function matchOTP($user,$otp,$new_content,$type=null)
    {
        if ($otp != $user->otp) {
            return ['success' => false, 'message' => 'The verification code you entered is invalid'];
        } else {
            $user[$type."_verified_at"] = now();
            $user->otp = null;
            $new_content ? $user->$type = $new_content : '' ;
            $user["new_".$type] = null;
            $user->save();
            return ['success' => true,  'message' => 'Your '.$type.' has been verified'];
        }
    }


}
