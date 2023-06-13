<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\Driveway;
use App\Models\LawnSize;
use App\Models\Order;
use App\Models\OrderImage;
use App\Models\Property;
use App\Models\RecurringHistory;
use App\Models\Sidewalk;
use App\Models\SnowDepth;
use App\Models\SnowPlowingSchedule;
use App\Models\SubCategory;
use App\Models\Transaction;
use App\Models\Walkway;
use App\Models\Wallet;
use App\Traits\OrderTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SnowPlowingController extends ClientBaseController
{
    use OrderTrait;

    public function startIndex()
    {   
        return view('client.snow-plowing.start');
    }

    public function addressIndex($type)
    {
        $this->type = ucfirst($type);
        return view('client.snow-plowing.address',$this->data);
    }

    public function address(Request $req,$type)
    {
        $req->validate([
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $data = $req->except('_token');
        $data['category_id'] = 2;
        $data['user_id'] = auth()->user() ? auth()->user()->id : null;
        $data['user_ip'] = $req->ip();

        //$property = Property::whereCategoryId($data['category_id'])->whereUserId(auth()->id())->whereLat($data['lat'])->whereLng($data['lng'])->first();
        $property = Property::whereCategoryId($data['category_id'])->whereUserIp($req->ip())->whereLat($data['lat'])->whereLng($data['lng'])->first();

        if(!$property) {
            $property = Property::create($data);
        }

        return redirect(route('snow-plowing.steps',['type' => $type, 'property_id' => $property->id]));
    }

    public function steps($type,$property_id)
    {
        $this->type = ucfirst($type);
        $view = $type == 'car' ? 'car' : 'home-business';
        $this->property = Property::find($property_id);
        if(!$this->property) return redirect(route('snow-plowing.start'));
        $this->snowPlowingSchedules = SnowPlowingSchedule::get();
        if($type != 'car') $this->snowDepths = SnowDepth::whereType($type)->get();
        if($type == 'car'){
            $this->carTypes = SubCategory::get();
            $this->colors = Color::get();
        }

        return view('client.snow-plowing.'.$view.'-steps',$this->data);
    }

    public function orderSummary(Request $request)
    {
        try {
            $order_id = $this->getNextOrderNumber();
            $property = Property::find($request->property_id);
            $adminCommission = settings('admin_commission');
            $adminFee = settings('admin_feeSnow');
            $taxRate = settings('tax_rate_snow');

            $subTotal = [];
            $subTotal[] =  (float) $adminFee;

            $order = new Order;
            $order->order_id           = $order_id;
            $order->user_id            = Auth::id()?Auth::id():null;
            $order->user_ip            = $property->user_ip;
            $order->category_id        = 2;
            $order->property_id        = $property->id;
            $order->lat                = $property->lat;
            $order->lng                = $property->lng;
            $order->service_for        = $request->service_for;
            $order->instructions       = $request->instructions ?? null;
            $order->sidewalk_sizes     = $request->sidewalk == 'true' ? $request->sidewalks : null;
            $order->walkway_sizes      = $request->walkway == 'true' ? $request->walkways : null;

            if($request->schedule_id != 3 ){
                $order->date = Carbon::now()->addDay(1)->format('Y-m-d');
            }else{
                $order->date = Carbon::now()->format('Y-m-d');
            }

            if($request->service_for == "Car"){
                $carType = SubCategory::find($request->car_id);
                if(!$carType) return response()->json('Car type not found',500);
            }


            if($request->service_for == "Home" || $request->service_for == "Business"){

                $driveway  = Driveway::where('type',$request->service_for)->first();

                if($request->sidewalk == 'true'){
                    $sidewalk  = Sidewalk::where('name',$request->sidewalks)->where('type',$request->service_for)->first();
                    $sidewalkAmount = $sidewalk ? $sidewalk->price : 0;
                }

                if($request->walkway == 'true'){
                    $walkway  = Walkway::where('name',$request->walkways)->where('type',$request->service_for)->first();
                    $walkwayAmount = $walkway ? $walkway->price : 0;
                }
            }

            $order->subcategory_id          = $carType->id ?? null;
            $order->subcategory_amount      = $subTotal[] = $carType->price ?? null;
            $order->color_id                = $request->color_id ?? null;
            $order->car_number              = $request->car_number ?? null;
            $order->snow_depth_id           = $request->snow_depth ?? null;
            $order->snow_depth_amount       = $subTotal[] = SnowDepth::where('type',$request->service_for)->find($order->snow_depth_id)->price ??null;
            $order->snow_plowing_schedule_id  = $request->schedule_id;
            $order->driveway                = $request->driveway_width ?? 0 * $request->driveway_length ?? 0;
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
            $orderExits = Order::whereCategoryId(2)->whereUserIp($property->user_ip)->wherePropertyId($property->id)->whereLat($property->lat)->whereLng($property->lng)->first();
            if(!$orderExits){
                $order->save();
            }else{
                $order=$orderExits;
            }

            $this->uploadOrderImages($request,$order_id,$order);

            $this->order = Order::find($order->id);
            $this->type = $request->service_for;

            return view('client.snow-plowing.__summary',$this->data);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(),500);
        }
    }

    public function updateTip(Request $request)
    {
        try {
            $response = $this->updatingTip($request);
            if($response) return $response;
            return view('client.snow-plowing.__summary',$this->data)->with('success','Tip updated successfully');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(),500);
        }
    }

    public function applyCouponDiscount(Request $request)
    {
        try {
            $response = $this->applyCoupon($request);
            if($response) return $response;
            return view('client.snow-plowing.__summary',$this->data)->with('success','Coupon applied successfully');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(),500);
        }
    }

    public function removeCouponDiscount(Request $request)
    {
        try {
            $response = $this->removeCoupon($request);
            if($response) return $response;
            return view('client.snow-plowing.__summary',$this->data)->with('success','Discount removed successfully');
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