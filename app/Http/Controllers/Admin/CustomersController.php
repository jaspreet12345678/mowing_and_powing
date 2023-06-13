<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\User;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\CompanySetting;
use App\Models\Card;
use App\Models\Property;
use App\Models\FavoriteProvider;
use App\Mail\AppLogin;
use App\Models\EmailTemplate;
use SebastianBergmann\Type\NullType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Datatables;
use App\Traits\OrderTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Signup;
use App\Mail\EmailVerification;


class CustomersController extends AdminBaseController
{
    use OrderTrait;
    public function index()
    {
        $this->active_customer = User::where('type', 'customer')->where('status', 1)->count();
        $this->pending_customer = User::where('type', 'customer')->where('status', 2)->count();
        $this->block_customer = User::where('type', 'customer')->where('status', 3)->count();
        return view('admin.users.customers.index', $this->data);
    }

    //View Page For Add Customer
    public function addNewCustomer()
    {
        return view('admin.users.customers.create');
    }

    public function registerNewCustomer()
    {
        if (session('email')) return view('admin.users.customers.create', ['email' => session('email')]);
    }

    //First Step of SignUp User
    public function signUp(Request $req)
    {

        try {
            $validator = Validator::make($req->all(), [
                'email' => 'required|email',
                'phone_number' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $userWithPhoneNumber = User::where('phone_number', $req->phone_number)->first();

            if ($userWithPhoneNumber && $userWithPhoneNumber->phone_number_verified_at && $userWithPhoneNumber->password) {
                return back()->with('error', 'Phone number has been taken');
            } elseif ($userWithPhoneNumber && $userWithPhoneNumber->status == 2) {
                $userWithPhoneNumber->delete();
            }

            $userWithEmail = User::where('email', $req->email)->first();

            if ($userWithEmail && $userWithEmail->email_verified_at && $userWithEmail->password) {
                return back()->with('error', 'Email has been taken');
            } elseif ($userWithEmail && $userWithEmail->status == 2) {
                $userWithEmail->delete();
            }

            $user = User::create([
                'email' => $req->email,
                'phone_number' => $req->phone_number,
                'type' => 'customer',
            ]);

            $otp = rand(111111, 999999);
            $user->otp = $otp;
            $user->save();

            Mail::to($req->email)->send(new EmailVerification('Sir/Madam', $otp));
            return redirect(route('admin.users.verify-email'))->with('email', $req->email);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    //Show page for email verifiction
    public function verifyEmailIndex()
    {
        if (!session('email')) return redirect(route('admin.users.customers.index'));
        return view('admin.users.customers.verify-email', ['email' => session('email')]);
    }


    //Email Verification
    public function verifyEmail(Request $req)
    {

        try {
            $data = $req->except('_token');
            $otp = '';
            foreach ($data['otp'] as $key => $value) {
                $otp .= $value;
            };
            $user = User::where('email', $req->email)->first();

            if ($otp != $user->otp) {

                return redirect()->back()->with(['email' => $req->email, 'error' => "Your verification code is not correct"]);
            } else {

                $user->email_verified_at = now();
                $otp = rand(111111, 999999);
                $user->otp = $otp;
                $user->save();
                $this->sendSms($user->phone_number, 'This is your 6 digit code ' . $otp);
                return redirect(route('admin.users.verify-phone-number'))->with(['success' => 'Email has been verified. Now kindly verify phone number', 'phone_number' => $user->phone_number, 'email' => $req->email]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    //Show Page For Phoen verifictaion
    public function verifyPhoneNumberIndex()
    {
        if (!session('phone_number') || !session('email')) return redirect(route('admin.users.customers.index'));
        return view('admin.users.customers.verify-phone-number', ['phone_number' => session('phone_number'), 'email' => session('email')]);
    }

    //Phone number verification
    public function verifyPhoneNumber(Request $req)
    {

        $data = $req->except('_token');
        $otp = '';
        foreach ($data['otp'] as $key => $value) {
            $otp .= $value;
        };
        $user = User::where('email', $req->email)->first();

        if ($otp != $user->otp) {
            return redirect()->back()->with(['email' => $user->email, 'phone_number' => $user->phone_number, 'error' => "Your verification code is not correct"]);
        } else {
            $user->phone_number_verified_at = now();
            $user->otp = null;
            $user->save();
            return redirect(route('admin.users.register-customer'))->with(['success' => 'Phone number has been verified. Now kindly create your account', 'email' => $user->email]);
        }
    }

    //Redend code for email as well phone number
    public function resendCode(Request $req)
    {

        try {
            if ($req->resend_for === 'email') {
                $user = User::where('email', $req->email)->first();
            } elseif ($req->resend_for === 'phone_number') {
                $user = User::where('phone_number', $req->phone_number)->first();
            }

            $otp = rand(111111, 999999);
            $user->otp = $otp;
            $user->save();

            if ($req->resend_for === 'email') {
                Mail::to($req->email)->send(new EmailVerification($user->first_name, $otp));
                // Log::info('Code resent. Your verification code for email verification is '.$otp);
            } elseif ($req->resend_for === 'phone_number') {
                $this->sendSms($user->phone_number, 'This is your 6 digit code ' . $otp);
            }

            return response()->json(['success' => true, 'message' => 'New verification code has been sent']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something unexpected happened on server. ' . $th->getMessage()]);
        }
    }


    //Store New Customer
    public function Store(Request $req)
    {
        $req->validate([
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|max:10',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|confirmed',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $req['phone_number'] = "+1".$req->phone_number;

        $check_phone = User::where('phone_number', $req->phone_number)->first();
        if (!empty($check_phone)) {
            return back()->with('error', 'Phone Number Already Exist');
        }
        $user = new User();
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->password = Hash::make($req->password);
        $user->default_password = $req->password;
        $user->address = $req->address;
        $user->lat = $req->lat;
        $user->lng = $req->lng;
        $user->phone_number = $req->phone_number;
        $user->email = $req->email;
        $user->phone_number_verified_at = now();
        $user->email_verified_at = now();
        $user->type = 'customer';
        $user->referral_link = "/referral-link/" . Str::random(16);


        $user->status = 1;


        if ($req->image) {
            $foldername = '/uploads/clients/profile pics/';
            $filename = time() . '-' . rand(0000000, 9999999) . '.' . $req->file('image')->extension();
            $req->file('image')->move(public_path() . $foldername, $filename);
            $user->image = $foldername . $filename;
        }

        $user->customer_id = $this->stripe->customers->create([
            'name' => $user->first_name . ' ' . $user->last_name,
            'email' => $user->email,
        ])->id;

        $user->save();

        Wallet::create(['user_id' => $user->id]);

        if ($req->refferal_link) {
            $referred_by = User::where('referral_link', $req->refferal_link)->first();
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
        return redirect()->route('admin.users.customers.index')->with('success', "Customer has been added Successfully!");
    }

    //Send login Email to every customer
    public function sendEmailToSingleCustomer($id)
    {
        $user_detail = User::where('type', 'customer')->where('id', $id)->first();
        $template = EmailTemplate::where('email_type', 'app_login')->first();
        $companyName = CompanySetting::first()->name;
        $url = route('web.login');
        $data['password'] = $user_detail->default_password;
        Mail::to($user_detail->email)->send(new AppLogin($user_detail->name, $url, $companyName, $user_detail->email, $data['password'], $template->content));
        return redirect()->back()->with('success', 'Email Send Successfully!');
    }

    //Pending Customers
    public function pendingCustomer(Request $request)
    {
        $this->active_customer = User::where('type', 'customer')->where('status', 1)->count();
        $this->pending_customer = User::where('type', 'customer')->where('status', 2)->count();
        $this->block_customer = User::where('type', 'customer')->where('status', 3)->count();
        if ($request->expectsJson()) {
            return Datatables::of(User::where('type', 'customer')->where('status', 2)->orderBy('id'))->make();
        }
        return view('admin.users.customers.pending', $this->data);
    }

    //Block Customers
    public function blockCustomer(Request $request)
    {
        $this->active_customer = User::where('type', 'customer')->where('status', 1)->count();
        $this->pending_customer = User::where('type', 'customer')->where('status', 2)->count();
        $this->block_customer = User::where('type', 'customer')->where('status', 3)->count();
        if ($request->expectsJson()) {
            return Datatables::of(User::where('type', 'customer')->where('status', 3)->orderBy('id'))->make();
        }
        return view('admin.users.customers.block', $this->data);
    }

    //Dlete Customers
    public function destroy($id)
    {
        try {
            User::find($id)->delete();
            session()->flash('success', 'Customer deleted successfully');
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong! Admin can not be deleted', 'error' => $th->getMessage()]);
        }
    }
    //Showing customer on index page through ajax
    public function data(Request $request)
    {
        if ($request->expectsJson()) {
            return Datatables::of(User::where('type', 'customer')->where('status', 1)->orderBy('id'))->make();
        }
        return view('admin.users.customers.index', $this->data);
    }

    //Show Detail page of every customer
    public function showUserDetail($id)
    {
        $customer = User::find($id);
        $properties = $customer->Property;
        $fav_provider = $customer->favoriteProviders;
        $order_detail = Order::where('User_id', $customer->id)->get();
        return view('admin.users.customers.show', compact('customer', 'order_detail', 'fav_provider', 'properties'));
    }

    public function addCustomerProperties(Request $req)
    {
        $req->validate([
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $data = $req->except('_token');
        $data['category_id'] = $req->category == 'lawn-mowing' ? '1' : '2';
        $data['user_id'] = $req->user_id;

        $property = Property::whereCategoryId($data['category_id'])->whereUserId($req->user_id)->whereLat($data['lat'])->whereLng($data['lng'])->first();
        if ($property) return back()->with('error', 'Property already exists');

        Property::create($data);

        return back()->with('success', 'Property added successfully');
    }



    //Delete Property
    public function deleteProperty($id)
    {
        try {
            $property = Property::find($id);

            if ($property->orders->count() === 0) {
                $property->delete();
                session()->flash('success', 'Property deleted successfully');
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => "Property can not be deleted because it is associated with orders"]);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

    //Block User
    public function blockUser($id)
    {
        try {

            User::where('id', $id)->update(['status' => 3]);
            return redirect()->back()->with('success', 'Customer Block Successfully!');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong! Admin can not be deleted', 'error' => $th->getMessage()]);
        }
    }

    //Active User
    public function activeUser($id)
    {
        try {
            User::where('id', $id)->update(['status' => 1]);
            return redirect()->back()->with('success', 'Customer Activate Successfully!');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong! Admin can not be deleted', 'error' => $th->getMessage()]);
        }
    }
    //Update Customer Profile
    public function updateProfile(Request $req)
    {


        $req->validate([
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

        if ($req->lat) {
            User::where('email', $req->email)->update(['lat' => $req->lat, 'lng' => $req->lng]);
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
        return back()->with('success', 'Profile updated');
    }
}
