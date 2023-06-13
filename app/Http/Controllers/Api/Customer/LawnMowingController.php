<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Fence;
use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Validator;
use App\Models\LawnHeight;
use App\Models\LawnSize;
use App\Models\Setting;
use App\Models\Cleanup;
use App\Models\CornerLot;
use App\Models\Order;
use App\Models\RecurringHistory;
use App\Models\ServicePeriod;
use App\Models\Wallet;
use App\Traits\OrderTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LawnMowingController extends ApiBaseController
{
    use OrderTrait;

    public function getSizesAndPrices(Request $req)
    {
        try {
            $this->sizes = LawnSize::get();
            $this->heights = LawnHeight::get();
            $this->fences   = Fence::get();
            $this->todayCharges = settings('on_demand_fee');

            return parent::resp(true, 'Now add some details for Lawn service.', $this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function lawnSizeAndPrices(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), ['lawn_size_id' => 'required']);
            if ($validator->fails()) {return parent::resp(false, 'Validation errors', null, $validator->errors());}

            $this->cleanUps = LawnSize::find($req->lawn_size_id)->cleanUps;

            return parent::resp(true, 'Here are clean-up prices depending upon lawn size.',$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function serviceEstimations(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'lawn_size_id' => 'required',
                'lawn_height_id' => 'required'
            ]);
            if ($validator->fails()) {return parent::resp(false, 'Validation errors', null, $validator->errors());}

            // Same code as web (start)
            $lawn_size = LawnSize::find($req->lawn_size_id);
            $lawn_height = LawnHeight::find($req->lawn_height_id);

            $oneTimeEstimation      = [];
            $sevenDaysEstimation    = [];
            $tenDaysEstimation      = [];
            $fourteenDaysEstimation = [];

            $oneTimeEstimation[]      = $lawn_height->price;
            $oneTimeEstimation[]      = $lawn_size->price;
            $sevenDaysEstimation[]    = $lawn_size->seven_days_price;
            $tenDaysEstimation[]      = $lawn_size->ten_days_price;
            $fourteenDaysEstimation[] = $lawn_size->fourteen_days_price;

            if ($req->service_day == "Today") {
                if(Carbon::now()->hour(12)->isPast()){
                    return parent::resp(false, "Same day service is only available before 12 pm.");
                }
                $oneTimeEstimation[] = (float) settings('on_demand_fee');
            }

            if ($req->corner_lot == 'true') {
                $corner_lot   =  CornerLot::first();
                $oneTimeEstimation[] = $corner_lot->price;
                $sevenDaysEstimation[] = $corner_lot->seven_days_price;
                $tenDaysEstimation[] = $corner_lot->ten_days_price;
                $fourteenDaysEstimation[] = $corner_lot->fourteen_days_price;
            }

            if ($req->fence == 'true') {
                $fence   = Fence::where('id', $req->fence_id)->first();
                $oneTimeEstimation[]      = $fence->price;
                $sevenDaysEstimation[]    = $fence->seven_days_price;
                $tenDaysEstimation[]      = $fence->ten_days_price;
                $fourteenDaysEstimation[] = $fence->fourteen_days_price;
            }

            if ($req->cleanup == 'true') {
                $oneTimeEstimation[] = Cleanup::find($req->cleanup_id)->price;
            }

            $this->oneTime = array_sum($oneTimeEstimation);
            $this->sevenDays = array_sum($sevenDaysEstimation);
            $this->tenDays = array_sum($tenDaysEstimation);
            $this->fourteenDays = array_sum($fourteenDaysEstimation);

            return parent::resp(true, 'Here are estimated prices depending upon your choices.',$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function orderSummary(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'address' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'category_id' => 'required',
                'lawn_size_id' => 'required',
                'lawn_height_id' => 'required'
             ]);
            if ($validator->fails()) { return parent::resp(false, 'Validation errors', null, $validator->errors()); }

            $data = $req->all();
            $data['user_id'] = auth()->user()->id;

            $property = Property::whereCategoryId($data['category_id'])->whereUserId(auth()->id())->whereLat($data['lat'])->whereLng($data['lng'])->first();

            if ($property) {
                $req->property_id = $property->id;
            }else{
                $req->property_id = Property::create($data)->id;
            }

            // Same code as web (start)
            $order_id = $this->getNextOrderNumber();
            $adminCommission    = settings('admin_commission');

            $subTotal = [];

            $lawnSize = Lawnsize::find($req->lawn_size_id);
            $lawnHeight = LawnHeight::find($req->lawn_height_id);
            $adminFee = settings('admin_feeLawn');
            $taxRate = settings('tax_rate_lawn');
            $property = Property::find($req->property_id);

            $subTotal[] =  (float) $adminFee;
            $subTotal[] =  $lawnHeight->price;
            $subTotal[] =  $lawnSize->price;

            if($req->fence == 'true'){
                $fence = Fence::find($req->fence_id);
                $fencePrice = $subTotal[] = $fence[$req->service_delivery];
            }

            if($req->cleanup == 'true'){
                $cleanUp = Cleanup::find($req->cleanup_id);
                $cleanUpPrice = $subTotal[] = $cleanUp->price;
            }

            if($req->corner_lot == 'true'){
                $cornerLot = CornerLot::first();
                $cornerLotPrice = $subTotal[] = $cornerLot[$req->service_delivery];
            }

            $order = new Order;
            $order->order_id           = $order_id;
            $order->user_id            = Auth::id();
            $order->category_id        = 1;
            $order->property_id        = $property->id;
            $order->lat                = $property->lat;
            $order->lng                = $property->lng;
            $order->on_demand          = $req->service_day;

            if($req->service_day == "Today"){
                if(Carbon::now()->hour(12)->isPast()){
                    return parent::resp(false, "Something unexpected happened on server. Same day service is only available before 12 pm.");
                }
                $order->on_demand_fee = $subTotal[] = settings('on_demand_fee');
                $order->date = Carbon::now()->format('Y-m-d');
            } else {
                if(Carbon::parse($req->date)->isToday()){
                    return parent::resp(false, "You can not schedule job for today. Kindly select 'same day service' otherwise.");
                }
                $order->date = Carbon::parse($req->date)->format('Y-m-d');
            }

            $order->gate_code          = $req->gate_code ?? null;
            $order->instructions       = $req->instructions ?? null;
            $order->lawn_size_id       = $lawnSize->id;
            $order->lawn_size_amount   = $lawnSize->price;
            $order->lawn_height_id     = $lawnHeight->id;
            $order->lawn_height_amount = $lawnHeight[$req->service_delivery];
            $order->fence_id           = isset($fence) ? $fence->id : null;
            $order->fence_amount       = isset($fencePrice) ? $fencePrice : null;
            $order->cleanup_id         = isset($cleanUp) ? $cleanUp->id : null;
            $order->cleanup_amount     = isset($cleanUpPrice) ? $cleanUpPrice : null;
            $order->corner_lot_id      = isset($cornerLot) ? $cornerLot->id : null;
            $order->corner_lot_amount  = isset($cornerLotPrice) ? $cornerLotPrice : null;

            if($req->service_delivery == "price"){
                $order->service_type = 1;
            }else{
                $order->service_type = 2;
                $order->service_period_id = $req->service_period_id;
            }

            $order->admin_fee = $adminFee;
            $order->total_amount = array_sum($subTotal);
            $order->tax_perc  = $taxRate;
            $order->tax       = $taxRate/100 * $order->total_amount;
            $order->admin_commission_perc = $adminCommission;
            $remainingTotal = $order->total_amount - $adminFee;
            $order->admin_commission = $adminCommission/100 * $remainingTotal;
            $order->grand_total  = $order->total_amount + $order->tax;
            $order->provider_amount = $remainingTotal - $order->admin_commission;
            $order->save();

            if ($req->file('images')) {
                $this->orderImagesForApi($req,$order_id,$order);
            }

            if($req->service_delivery != "price"){

                $servicePeriod = ServicePeriod::find($req->service_period_id);
                $recurringTotalAmount[] = $lawnSize[$req->service_delivery];
                $recurringTotalAmount[] = isset($fence) ? $fence[$req->service_delivery] : 0;
                $recurringTotalAmount[] = isset($cornerLot) ? $cornerLot[$req->service_delivery] : 0;
                $recurringTotalAmount[] = $adminFee;

                $recurring_order = new RecurringHistory();
                $recurring_order->order_id           = $order_id;
                $recurring_order->user_id            = Auth::id();
                $recurring_order->provider_id        = 0;
                $recurring_order->category_id        = 1;
                $recurring_order->property_id        = $property->id;
                $recurring_order->lat                = $property->lat;
                $recurring_order->lng                = $property->lng;
                $recurring_order->on_every           = $servicePeriod->duration;
                $recurring_order->date               = Carbon::parse($order->date)->addDays($servicePeriod->duration)->format('Y-m-d');
                $recurring_order->lawn_size_id       = $order->lawn_size_id;
                $recurring_order->lawn_size_amount   = $lawnSize[$req->service_delivery];
                $recurring_order->fence_id           = $order->fence_id;
                $recurring_order->fence_amount       = $order->fence_amount;
                $recurring_order->corner_lot_id      = $order->corner_lot_id;
                $recurring_order->corner_lot_amount  = $order->corner_lot_amount;
                $recurring_order->admin_fee          = $order->admin_fee;
                $recurring_order->total_amount       = array_sum($recurringTotalAmount);
                $recurring_order->tax_perc           = $taxRate;
                $recurring_order->tax                = $taxRate/100 * $recurring_order->total_amount;
                $recurring_order->grand_total        = $recurring_order->tax  + $recurring_order->total_amount;
                $recurring_order->admin_commission_perc   = $adminCommission;
                $recurring_order->gate_code          = $order->gate_code;
                $recurring_order->instructions       = $order->instructions;
                $recurring_order->save();
            }

            $this->order = Order::find($order->id);

            return parent::resp(true, 'Here is your Order summary.',$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function updateTip(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'order_id' => 'required',
                'tip' => 'required',
                'tip_perc' => 'required'
            ]);
            if ($validator->fails()) { return parent::resp(false, 'Validation errors', null, $validator->errors()); }

            $response = $this->updatingTip($req);
            if($response) return $response;

            return parent::resp(true, 'Tip updated successfully',$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function applyCouponDiscount(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'order_id' => 'required',
                'code' => 'required'
            ]);
            if ($validator->fails()) { return parent::resp(false, 'Validation errors', null, $validator->errors()); }

            $response = $this->applyCoupon($req);
            if($response) return $response;
            return parent::resp(true, 'Coupon aplied successfully.',$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function removeCouponDiscount(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), ['order_id' => 'required']);
            if ($validator->fails()) { return parent::resp(false, 'Validation errors', null, $validator->errors()); }

            $response = $this->removeCoupon($req);
            if($response) return $response;
            return parent::resp(true, 'Discount removed successfully.',$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function pay(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'order_id' => 'required',
                'grandTotal' => 'required',
            ]);
            if ($validator->fails()) { return parent::resp(false, 'Validation errors', null, $validator->errors()); }

            $response = $this->payForOrder($req);
            if($response) return $response;

            $wallet = Wallet::whereUserId(auth()->user()->id)->first();

            return response()->json(['success' => true, 'message' => $this->message,$wallet]);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

}
