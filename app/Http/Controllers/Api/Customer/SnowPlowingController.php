<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\SnowDepth;
use App\Models\SnowPlowingSchedule;
use App\Models\SubCategory;
use App\Models\Color;
use App\Models\Driveway;
use App\Models\Sidewalk;
use App\Models\Order;
use App\Models\Walkway;
use App\Models\Wallet;
use App\Traits\OrderTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SnowPlowingController extends ApiBaseController
{
    use OrderTrait;

    public function carsAndSchedule(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), ['type' => 'required']);
            if ($validator->fails()) { return parent::resp(false, 'Validation errors', null, $validator->errors()); }

            $this->snowPlowingSchedules = SnowPlowingSchedule::get();
            if ($req->type != 'car') { $this->snowDepths = SnowDepth::whereType($req->type)->get(); }
            if ($req->type == 'car') {
                $this->carTypes = SubCategory::get();
                $this->colors = Color::get();
            }

            return parent::resp(true, 'Here are '.$req->type.' snow-plowing related category prices and schedule timing.',  $this->data);
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
                'service_for' => 'required',
                'schedule_id' => 'required'
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

            // Same as web (start)
            $order_id = $this->getNextOrderNumber();
            $property = Property::find($req->property_id);
            $adminCommission = settings('admin_commission');
            $adminFee = settings('admin_feeSnow');
            $taxRate = settings('tax_rate_snow');

            $subTotal = [];
            $subTotal[] =  (float) $adminFee;

            $order = new Order;
            $order->order_id           = $order_id;
            $order->user_id            = Auth::id();
            $order->category_id        = 2;
            $order->property_id        = $property->id;
            $order->lat                = $property->lat;
            $order->lng                = $property->lng;
            $order->service_for        = $req->service_for;
            $order->instructions       = $req->instructions ?? null;
            $order->sidewalk_sizes     = $req->sidewalk == 'true' ? $req->sidewalks : null;
            $order->walkway_sizes      = $req->walkway == 'true' ? $req->walkways : null;

            if($req->schedule_id != 3 ){
                $order->date = Carbon::now()->addDay(1)->format('Y-m-d');
            }else{
                $order->date = Carbon::now()->format('Y-m-d');
            }

            if($req->service_for == "Car"){
                $carType = SubCategory::find($req->car_id);
                if(!$carType) return response()->json('Car type not found',500);
            }

            if($req->service_for == "Home" || $req->service_for == "Business"){

                $driveway  = Driveway::where('type',$req->service_for)->first();

                if($req->sidewalk == 'true'){
                    $sidewalk  = Sidewalk::where('name',$req->sidewalks)->where('type',$req->service_for)->first();
                    $sidewalkAmount = $sidewalk ? $sidewalk->price : 0;
                }

                if($req->walkway == 'true'){
                    $walkway  = Walkway::where('name',$req->walkways)->where('type',$req->service_for)->first();
                    $walkwayAmount = $walkway ? $walkway->price : 0;
                }
            }

            $order->subcategory_id          = $carType->id ?? null;
            $order->subcategory_amount      = $subTotal[] = $carType->price ?? null;
            $order->color_id                = $req->color_id ?? null;
            $order->car_number              = $req->car_number ?? null;
            $order->snow_depth_id           = $req->snow_depth ?? null;
            $order->snow_depth_amount       = $subTotal[] = SnowDepth::where('type',$req->service_for)->find($order->snow_depth_id)->price ?? null;
            $order->snow_plowing_schedule_id  = $req->schedule_id;
            $order->driveway                = $req->driveway_width ?? 0 * $req->driveway_length ?? 0;
            $order->driveway_amount         = $subTotal[] = $order->driveway ? ($order->driveway <= 6 ? $driveway->on_first_6_cars : $driveway->on_first_6_cars + ($driveway->on_more_than_6_cars * ($order->driveway - 6))) : null;
            $order->sidewalk_amount         = $subTotal[] = $sidewalkAmount ?? null;
            $order->walkway_amount          = $subTotal[] = $walkwayAmount ?? null;
            $order->admin_fee               = $adminFee;
            $order->total_amount            = array_sum($subTotal);
            $order->tax_perc                = $taxRate;
            $order->tax                     = $taxRate/100 * $order->total_amount;
            $order->admin_commission_perc   = $adminCommission;
            $remainingTotal                 = $order->total_amount - $adminFee;
            $order->admin_commission        = $adminCommission/100 * $remainingTotal;
            $order->grand_total             = $order->total_amount + $order->tax;
            $order->provider_amount         = $remainingTotal - $order->admin_commission;
            $order->save();

            if ($req->file('images')) {
                $this->orderImagesForApi($req,$order_id,$order);
            }

            $this->order = Order::find($order->id);
            $this->type = $req->service_for;

            return parent::resp(true, 'Here is your Order summary.',  $this->data);
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
