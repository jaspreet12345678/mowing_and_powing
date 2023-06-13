<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Order;
use App\Models\Property;
use App\Models\RecurringHistory;
use App\Models\ServicePeriod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Traits\OrderTrait;
use Illuminate\Validation\Rule;


class CustomerByProviderController extends ApiBaseController
{
    use OrderTrait;

    public function customersCreatedByProvider()
    {
        try {
            if(auth()->user()->status != 1){
                return parent::resp(false, "Your account is not approved. Kindly wait for the admin to approve it...");
            }

           $this->cusstomers =  User::whereCreatedBy(auth()->user()->id)->whereStatus(1)->whereType('customer')->latest()->get();
           return parent::resp(true, 'Here are your own customers.',$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "On the server, an unforeseen event occurred" . $th->getMessage());
        }
    }

    public function orderByProvider(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'user_id' => 'required',
                'category_id' => 'required',
                'address' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'amount' => 'required',
                'service_delivery' => Rule::requiredif($req->category_id == 1),
                'recurring_amount' => Rule::requiredif(($req->category_id == 1) && ($req->service_delivery != 'one-time'))
            ]);
            if ($validator->fails()) {return parent::resp(false, 'Validation errors', null, $validator->errors());}

            $data = $req->all();

            $property = Property::whereCategoryId($data['category_id'])->whereUserId($data['user_id'])->whereLat($data['lat'])->whereLng($data['lng'])->first();

            if ($property) {
                $req->property_id = $property->id;
            }else{
                $req->property_id = Property::create($data)->id;
            }

            $property = Property::find($req->property_id);

            $order_id = $this->getNextOrderNumber();
            $adminCommission = settings('admin_commission');

            if($req->category_id == 2){
                $adminFee = settings('admin_feeSnow');
                $taxRate = settings('tax_rate_snow');
            } else {
                $adminFee = settings('admin_feeLawn');
                $taxRate = settings('tax_rate_lawn');
            }

            $order = new Order;
            $order->order_id           = $order_id;
            $order->user_id            = $req->user_id;
            $order->category_id        = $req->category_id;
            $order->property_id        = $property->id;
            $order->lat                = $property->lat;
            $order->lng                = $property->lng;
            $order->date = Carbon::now()->format('Y-m-d');
            $order->admin_fee = $adminFee;
            $order->total_amount_by_provider = $req->amount;
            $order->total_amount = $order->total_amount_by_provider + $adminFee;
            $order->assigned_to  = Auth::id();
            $order->provider_assigned_date = Carbon::now()->format('Y-m-d');
            $order->tax_perc  = $taxRate;
            $order->tax       = $taxRate/100 * $order->total_amount;
            $order->admin_commission_perc = $adminCommission;
            $remainingTotal = $order->total_amount - $adminFee;
            $order->admin_commission = $adminCommission/100 * $remainingTotal;
            $order->provider_amount = $remainingTotal - $order->admin_commission;
            $order->grand_total  = $order->total_amount + $order->tax;
            $order->status = 2;
            $req->category_id == 2 ? $order->service_for = "Home" : Null;

            if($req->category_id == 1) {
                if($req->service_delivery == "one-time"){
                    $order->service_type = 1;
                }else{
                    $order->service_type = 2;
                    $order->service_period_id = $req->service_period_id;
                }
            }
            $order->save();

            if ($req->file('images')) {
                $this->orderImagesForApi($req,$order_id,$order);
            }

            if($req->category_id == 1) {

                if($req->service_delivery != "one-time"){
                    $servicePeriod = ServicePeriod::find($req->service_period_id);

                    $recurring_order = new RecurringHistory();
                    $recurring_order->order_id                 = $order_id;
                    $recurring_order->user_id                  = $req->user_id;
                    $recurring_order->provider_id              = Auth::id();
                    $recurring_order->category_id              = 1;
                    $recurring_order->property_id              = $property->id;
                    $recurring_order->lat                      = $property->lat;
                    $recurring_order->lng                      = $property->lng;
                    $recurring_order->on_every                 = $servicePeriod->duration;
                    $recurring_order->date                     = Carbon::parse($order->date)->addDays($servicePeriod->duration)->format('Y-m-d');
                    $recurring_order->lawn_size_id             = null;
                    $recurring_order->lawn_size_amount         = 0;
                    $recurring_order->fence_id                 = null;
                    $recurring_order->fence_amount             = 0;
                    $recurring_order->corner_lot_id            = null;
                    $recurring_order->corner_lot_amount        = 0;
                    $recurring_order->admin_fee                = $order->admin_fee;
                    $recurring_order->total_amount_by_provider = $req->recurring_amount;
                    $recurring_order->total_amount             = $recurring_order->total_amount_by_provider + $adminFee;
                    $recurring_order->tax_perc                 = $taxRate;
                    $recurring_order->tax                      = $taxRate/100 * $recurring_order->total_amount;
                    $recurring_order->grand_total              = $recurring_order->tax  + $recurring_order->total_amount;
                    $recurring_order->admin_commission_perc    = $adminCommission;
                    $recurring_order->save();
                }
            }
            $this->order = Order::find($order->id);

            if(($req->category_id == 1) && ($req->service_delivery != 'one-time')) {
                $this->recurring_order = RecurringHistory::find($recurring_order->id);
            }

            return parent::resp(true,'Order is created of this Customer.' ,$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function addCardAndPay(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'user_id' => 'required',
                'card_number' => 'required',
                'exp_month' => 'required',
                'exp_year' => 'required',
                'cvv' => 'required',
                'order_id' => 'required',
                'grandTotal' => 'required',
            ]);
            if ($validator->fails()) { return parent::resp(false, 'Validation errors', null, $validator->errors()); }

            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $req->card_number,
                    'exp_month' => $req->exp_month,
                    'exp_year' => $req->exp_year,
                    'cvc' => $req->cvv,
                ],
            ]);

            $user = User::find($req->user_id);
            $card = $this->stripe->customers->createSource(
                $user->customer_id,
                ['source' => $token->id]
            )->toArray();

            $card['card_id'] = $card['id'];
            $card['user_id'] = $user->id;
            $card['customer_id'] = $user->customer_id;
            $card['card_number'] = $req->card_number;
            $card['cvv'] = $req->cvv;
            $card['is_default'] = Card::where('user_id', $user->id)->where('is_default', '1')->first() ? '0' : '1';

            Card::create($card);
            $response = $this->payForOrder($req,$user);
            if($response) return $response;
            return response()->json(['success' => true, 'message' => $this->message]);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }
}
