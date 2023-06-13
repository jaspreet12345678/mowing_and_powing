<?php

namespace App\Http\Controllers\Client;

use App\Jobs\SendJobRequestsToRemainingProviders;
use App\Models\Card;
use App\Models\Cleanup;
use App\Models\CornerLot;
use App\Models\Coupon;
use App\Models\FavoriteProvider;
use App\Models\Fence;
use App\Models\LawnHeight;
use App\Models\LawnSize;
use App\Models\Order;
use App\Models\OrderImage;
use App\Models\Property;
use App\Models\RecurringHistory;
use App\Models\ServicePeriod;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\OrderTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LawnMowingController extends ClientBaseController
{
    use OrderTrait;

    public function startIndex()
    {
        return view('client.lawn-mowing.start');
    }

    public function start(Request $req)
    {
        $req->validate([
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $data = $req->except('_token');
        $data['category_id'] = 1;
        $data['user_id'] = auth()->user() ? auth()->user()->id : null;
        $data['user_ip'] = $req->ip();

       // $property = Property::whereCategoryId($data['category_id'])->whereUserId(auth()->id())->whereLat($data['lat'])->whereLng($data['lng'])->first();
        $property = Property::whereCategoryId($data['category_id'])->whereUserIp($req->ip())->whereLat($data['lat'])->whereLng($data['lng'])->first();

        if(!$property) {
            $property = Property::create($data);
        }

        return redirect(route('lawn-mowing.steps',$property->id));
    }

    public function steps($property_id)
    {
        $this->property = Property::find($property_id);
        if(!$this->property) return redirect(route('lawn-mowing.start'));
        return view('client.lawn-mowing.steps',$this->data);
    }

    public function getCleanUps(Request $req)
    {
        $cleanUps = LawnSize::find($req->id)->cleanUps;
        return response()->json(['success'=>true,'data'=>$cleanUps]);
    }

    public function getEstimations(Request $request){

        $lawn_size = LawnSize::find($request->lawnSize);
        $lawn_height = LawnHeight::find($request->lawnHeight);

        $oneTimeEstimation      = [];
        $sevenDaysEstimation    = [];
        $tenDaysEstimation      = [];
        $fourteenDaysEstimation = [];

        $oneTimeEstimation[]      = $lawn_height->price;
        $oneTimeEstimation[]      = $lawn_size->price;
        $sevenDaysEstimation[]    = $lawn_size->seven_days_price;
        $tenDaysEstimation[]      = $lawn_size->ten_days_price;
        $fourteenDaysEstimation[] = $lawn_size->fourteen_days_price;

        if($request->service_day == "Today"){
            if(Carbon::now()->hour(12)->isPast()){
                return response()->json(['success' => false, 'message' => "Same day service is only available before 12 pm."]);
            }
            $oneTimeEstimation[] = (float) settings('on_demand_fee');
        } else {
            if(Carbon::parse($request->scheduled_date)->isToday()){
                return response()->json(['success' => false, 'message' => "You can not schedule job for today. Kindly select 'same day service' otherwise."]);
            }
        }

        if($request->corner_lot == 'true'){
            $corner_lot   =  CornerLot::first();
            $oneTimeEstimation[] = $corner_lot->price;
            $sevenDaysEstimation[] = $corner_lot->seven_days_price;
            $tenDaysEstimation[] = $corner_lot->ten_days_price;
            $fourteenDaysEstimation[] = $corner_lot->fourteen_days_price;
        }

        if($request->fence == 'true'){
            $fence   = Fence::where('id',$request->fence_id)->first();
            $oneTimeEstimation[]      = $fence->price;
            $sevenDaysEstimation[]    = $fence->seven_days_price;
            $tenDaysEstimation[]      = $fence->ten_days_price;
            $fourteenDaysEstimation[] = $fence->fourteen_days_price;
        }

        if($request->cleanup == 'true'){
            $oneTimeEstimation[] = Cleanup::find($request->cleanup_id)->price;
        }

        $this->oneTime = array_sum($oneTimeEstimation);
        $this->sevenDays = array_sum($sevenDaysEstimation);
        $this->tenDays = array_sum($tenDaysEstimation);
        $this->fourteenDays = array_sum($fourteenDaysEstimation);

        return response()->json(['success' => true, 'data' => $this->data]);
    }

    public function orderSummary(Request $request)
    {
        try {
            $order_id = $this->getNextOrderNumber();
            $adminCommission    = settings('admin_commission');

            $subTotal = [];

            $lawnSize = Lawnsize::find($request->lawnSize);
            $lawnHeight = LawnHeight::find($request->lawnHeight);
            $adminFee = settings('admin_feeLawn');
            $taxRate = settings('tax_rate_lawn');
            $property = Property::find($request->property_id);

            $subTotal[] =  (float) $adminFee;
            $subTotal[] =  $lawnHeight->price;
            $subTotal[] =  $lawnSize->price;

            if($request->fence == 'true'){
                $fence = Fence::find($request->fence_id);
                $fencePrice = $subTotal[] = $fence[$request->service_delivery];
            }

            if($request->cleanup == 'true'){
                $cleanUp = Cleanup::find($request->cleanup_id);
                $cleanUpPrice = $subTotal[] = $cleanUp->price;
            }

            if($request->corner_lot == 'true'){
                $cornerLot = CornerLot::first();
                $cornerLotPrice = $subTotal[] = $cornerLot[$request->service_delivery];
            }

            $order = new Order;
            $order->order_id           = $order_id;
            $order->user_id            = Auth::id()?Auth::id():null;
            $order->user_ip            = $property->user_ip;
            $order->category_id        = 1;
            $order->property_id        = $property->id;
            $order->lat                = $property->lat;
            $order->lng                = $property->lng;
            $order->on_demand          = $request->service_day;

            if($request->service_day == "Today"){
                if(Carbon::now()->hour(12)->isPast()){
                    return response()->json("Same day service is only available before 12 pm.",500);
                }
                $order->on_demand_fee = $subTotal[] = settings('on_demand_fee');
                $order->date = Carbon::now()->format('Y-m-d');
            } else {
                if(Carbon::parse($request->date)->isToday()){
                    return response()->json("You can not schedule job for today. Kindly select 'same day service' otherwise.",500);
                }
                $order->date = Carbon::parse($request->date)->format('Y-m-d');
            }

            $order->gate_code          = $request->gate_code ?? null;
            $order->instructions       = $request->instructions ?? null;
            $order->lawn_size_id       = $lawnSize->id;
            $order->lawn_size_amount   = $lawnSize->price;
            $order->lawn_height_id     = $lawnHeight->id;
            $order->lawn_height_amount = $lawnHeight[$request->service_delivery];
            $order->fence_id           = isset($fence) ? $fence->id : null;
            $order->fence_amount       = isset($fencePrice) ? $fencePrice : null;
            $order->cleanup_id         = isset($cleanUp) ? $cleanUp->id : null;
            $order->cleanup_amount     = isset($cleanUpPrice) ? $cleanUpPrice : null;
            $order->corner_lot_id      = isset($cornerLot) ? $cornerLot->id : null;
            $order->corner_lot_amount  = isset($cornerLotPrice) ? $cornerLotPrice : null;

            if($request->service_delivery == "price"){
                $order->service_type = 1;
            }else{
                $order->service_type = 2;
                $order->service_period_id = $request->service_period_id;
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

            $orderExits = Order::whereCategoryId(1)->whereUserIp($property->user_ip)->wherePropertyId($property->id)->whereLat($property->lat)->whereLng($property->lng)->first();
            if(!$orderExits){
                $order->save();
            }else{
                $order=$orderExits;
            }

            $this->uploadOrderImages($request,$order_id,$order);

            if($request->service_delivery != "price"){

                $servicePeriod = ServicePeriod::find($request->service_period_id);
                $recurringTotalAmount[] = $lawnSize[$request->service_delivery];
                $recurringTotalAmount[] = isset($fence) ? $fence[$request->service_delivery] : 0;
                $recurringTotalAmount[] = isset($cornerLot) ? $cornerLot[$request->service_delivery] : 0;
                $recurringTotalAmount[] = $adminFee;

                $recurring_order = new RecurringHistory();
                $recurring_order->order_id           = $order_id;
                $recurring_order->user_id            = Auth::id()?Auth::id():null;
                $recurring_order->user_ip            = $property->user_ip;
                $recurring_order->provider_id        = 0;
                $recurring_order->category_id        = 1;
                $recurring_order->property_id        = $property->id;
                $recurring_order->lat                = $property->lat;
                $recurring_order->lng                = $property->lng;
                $recurring_order->on_every           = $servicePeriod->duration;
                $recurring_order->date               = Carbon::parse($order->date)->addDays($servicePeriod->duration)->format('Y-m-d');
                $recurring_order->lawn_size_id       = $order->lawn_size_id;
                $recurring_order->lawn_size_amount   = $lawnSize[$request->service_delivery];
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

            return view('client.lawn-mowing.__summary',$this->data);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(),500);
        }
    }

    public function updateTip(Request $request)
    {
        try {
            $response = $this->updatingTip($request);
            if($response) return $response;
            return view('client.lawn-mowing.__summary',$this->data)->with('success','Tip updated successfully');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(),500);
        }
    }

    public function applyCouponDiscount(Request $request)
    {
        try {
            $response = $this->applyCoupon($request);
            if($response) return $response;
            return view('client.lawn-mowing.__summary',$this->data)->with('success','Coupon applied successfully');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(),500);
        }
    }

    public function removeCouponDiscount(Request $request)
    {
        try {
            $response = $this->removeCoupon($request);
            if($response) return $response;
            return view('client.lawn-mowing.__summary',$this->data)->with('success','Discount removed successfully');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(),500);
        }
    }

    public function pay(Request $request)
    {
        try {
            
            $response = $this->payForOrder($request);
            if($response) return $response;
            return response()->json(['success' => true, 'message' => $this->message]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(),500);
        }
    }

}
