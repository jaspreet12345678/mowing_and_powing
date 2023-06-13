<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Models\BankDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentsController extends ApiBaseController
{
    public function addStripeAccount(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'ssn_last_4' => 'required',
                'city' => 'required',
                'state' => 'required',
                'postal_code' => 'required',
                'dob' => 'required',
                'address' => 'required',
                'routing_number' => 'required',
                'account_number' => 'required'
            ]);
            if ($validator->fails()) { return parent::resp(false, 'Validation errors', null, $validator->errors()); }

            $dob = $req->dob;
            $dob = explode('-', $dob);

            $provider = User::find(auth()->id());

            $account = $this->stripe->accounts->create([
                'type' => 'custom',
                'country' => 'US',
                'business_type' => 'individual',
                'capabilities' => [
                    'card_payments' => ['requested' => true],
                    'transfers' => ['requested' => true],
                ],
                'tos_acceptance' => [
                    'date' => Carbon::now()->timestamp,
                    'ip' => $req->ip(),
                ],
                'individual' => [
                    'ssn_last_4' => $req->ssn_last_4,
                    'first_name' => $provider->first_name,
                    'last_name' => $provider->last_name,
                    'dob' => ['day' => $dob[0], 'month' => $dob[1], 'year' => $dob[2]],
                    'phone' =>  $provider->phone_number,
                    'email' => $provider->email ? $provider->email : $provider->unverified_email,
                    'address' => [
                        'city' => $req->city,
                        'line1' => $req->address,
                        'postal_code' => $req->postal_code,
                        'state' => $req->state
                    ],
                ],
                'external_account' => [
                    'object' => 'bank_account',
                    'country' => 'US',
                    'currency' => 'usd',
                    'routing_number' => $req->routing_number,
                    'account_number' => $req->account_number,
                ],
                'business_profile' => [
                    'mcc' => '1520',
                    'url' => 'mowingandplowing.com'
                ]
            ]);

            if ($account->capabilities->card_payments != 'Inactive' && $account->capabilities->transfers != 'Inactive') {

                $this->bank = new BankDetail();
                $this->bank->provider_id = auth()->user()->id;
                $this->bank->account_id = $account->id;
                $this->bank->routing_number = $req->routing_number;
                $this->bank->account_number = $req->account_number;
                $this->bank->bank_name = $account->external_accounts->data[0]->bank_name;
                $this->bank->ssn_last_4 = $req->ssn_last_4;
                $this->bank->city = $req->city;
                $this->bank->state = $req->state;
                $this->bank->postal_code = $req->postal_code;
                $this->bank->address = $req->address;
                $this->bank->dob = Carbon::createFromFormat('d-m-Y',$req->dob)->format('Y/m/d');
                $this->bank->save();

                $this->user = User::find(auth()->user()->id);
                $this->user->provider_account_id = $account->id;
                $this->user->update();

                return parent::resp(true, 'Your bank account has been created.', $this->data);
            } else {
                return parent::resp(false, 'There was a problem while adding your bank account');
            }

        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function deleteAccount($id , $account_id)
    {
        try {
            BankDetail::whereId($id)->whereAccountId($account_id)->delete();

            $this->stripe->accounts->delete($account_id);

            $this->user = User::find(auth()->user()->id);
            $this->user->provider_account_id = null;
            $this->user->update();

            return parent::resp(true, 'Your bank account has been deleted.', $this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function getStripeAccount()
    {
        try {
            $bank = BankDetail::whereProviderId(auth()->user()->id)->latest()->get();
            return parent::resp(true, "Here is your bank account", $bank);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }
}
