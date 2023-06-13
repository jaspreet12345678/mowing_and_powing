<?php

namespace App\Traits;

use App\Jobs\SendJobRequestsToRemainingProviders;
use App\Jobs\SendSms;
use App\Models\Card;
use App\Models\Coupon;
use App\Models\FavoriteProvider;
use App\Models\Order;
use App\Models\OrderImage;
use App\Models\RecurringHistory;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait OrderTrait {

    public function updatingTip(Request $request)
    {
        $order = Order::find($request->order_id);
        if(empty($order)) return response()->json('Order does not exist',404);

        $grandTotal = $order->grand_total - $order->tip;
        $providerAmount = $order->provider_amount - $order->tip;
        $order->tip_type = $request->tip ? $request->tip_type : null;
        $order->tip_perc = $request->tip_perc ?? 0;
        $order->tip = $request->tip;
        $order->grand_total  = $grandTotal + $request->tip;
        $order->provider_amount = $providerAmount + $request->tip;
        $order->save();

        $recurringHistory = RecurringHistory::where('order_id',$order->order_id)->first();

        if($recurringHistory){
            if($request->tip_type == 'recurring' && $request->tip != '0'){
                $recurringHistory->tip = $recurringHistory->total_amount/100 * $request->tip_perc;
                $recurringHistory->grand_total = $recurringHistory->grand_total + $recurringHistory->tip;
                $recurringHistory->save();
            }else{
                $recurringHistory->grand_total = $recurringHistory->grand_total - $recurringHistory->tip;
                $recurringHistory->tip = 0;
                $recurringHistory->save();
            }
        }

        $this->order = Order::find($order->id);
        $this->type = $order->service_for;
    }

    public function applyCoupon(Request $request)
    {
        if(!$request->code) return response()->json('Please add promo code',500);

        $coupon = Coupon::where('name',$request->code)->first();
        if(empty($coupon)) return response()->json('Invalid coupon code',500);

        $todayDate = Carbon::createFromFormat('Y-m-d H:i:s',Carbon::today());
        if($todayDate->gt($coupon->valid_till)) return response()->json('Coupon has expired',500);

        $order = Order::find($request->order_id);

        if($order->discount_amount) return response()->json('Coupon already applied on this order',500);

        if($coupon->service != 3){
            if($order->category_id != $coupon->service ) return response()->json('This coupon is not for this service',500);
        }

        $discountAmount = 0;

        if($coupon->type == 1){
            $discountAmount =  $coupon->discount;
        }
        if($coupon->type == 2){
            $discountAmount =  $coupon->discount/100 * $order->total_amount;
        }

        $order->total_amount       = $order->total_amount - $discountAmount;
        $order->coupon_id          = $coupon->id;
        $order->coupon_code        = $coupon->name;
        $order->coupon_type        = $coupon->type;
        $order->discount_value     = $coupon->discount;
        $order->discount_amount    = $discountAmount;
        $order->tax                = $order->tax_perc/100 * $order->total_amount;
        if($order->tip){
            $order->tip = round($order->total_amount/100 * $order->tip_perc,2);
        }
        $order->grand_total        = $order->total_amount + $order->tax + $order->tip;
        $remainingTotal            = $order->total_amount - $order->admin_fee;
        $order->admin_commission   = $order->admin_commission_perc/100 * $remainingTotal;
        $order->provider_amount    = $remainingTotal - $order->admin_commission + $order->tip;
        $order->save();

        $this->order = Order::find($order->id);
        $this->type = $order->service_for;
    }

    public function removeCoupon(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->total_amount       = $order->total_amount + $order->discount_amount;
        $order->coupon_id          = 0;
        $order->coupon_code        = '';
        $order->coupon_type        = 0;
        $order->discount_value     = '';
        $order->discount_amount    = 0;
        $order->tax                = $order->tax_perc/100 * $order->total_amount;
        if($order->tip){
            $order->tip = round($order->total_amount/100 * $order->tip_perc,2);
        }
        $order->grand_total        = $order->total_amount + $order->tax + $order->tip;
        $remainingTotal            = $order->total_amount - $order->admin_fee;
        $order->admin_commission   = $order->admin_commission_perc/100 * $remainingTotal;
        $order->provider_amount    = $remainingTotal - $order->admin_commission + $order->tip;
        $order->save();

        $this->order = Order::find($order->id);
        $this->type = $order->service_for;
    }

    public function payForOrder(Request $request,$user = null)
    {
        $order = Order::find($request->order_id);
        if(empty($order)) return response()->json('Order does not exist',404);
        if($order->payment_status == 2) return response()->json('Payment has already done for this order',500);

        $wallet = Wallet::whereUserId($user ? $user->id : auth()->id())->first();
        $this->message = 'Order placed successfully';

        if($wallet->amount > $request->grandTotal) {
            $wallet->amount = $wallet->amount - $request->grandTotal;
            $wallet->save();
            $this->makeTransaction($order,'wallet',$request->grandTotal,null,$user ? $user->id : null);
            $this->message = 'Payed from M&P Wallet';
        }else {
            $exceedingAmount = $request->grandTotal - $wallet->amount;

            $card = getDefaultCard($user ? $user->id : null);
            if(empty($card)) return response()->json('Kindly add a debit or credit card number',404);

            $charge = $this->stripe->charges->create([
                'amount' => $exceedingAmount * 100,
                'currency' => 'usd',
                'customer' => $user ? $user->customer_id : auth()->user()->customer_id,
                'source' => $card->card_id,
                'description' => $user ? $user->first_name.' '.$user->last_name.' was charged for '. $order->category->name .' order (Exceeding charges)' :
                    auth()->user()->first_name.' '.auth()->user()->last_name.' was charged for '. $order->category->name .' order (Exceeding charges)',
            ]);

            $this->makeTransaction($order,'card',$charge['amount_captured'] / 100,$charge,$user ? $user->id : null);
            if($exceedingAmount != $request->grandTotal) $this->makeTransaction($order,'wallet',$wallet->amount,null,$user ? $user->id : null);

            $wallet->amount = 0;
            $wallet->save();
            $this->message = 'Payed from M&P Wallet and default Payment method';
        }

        $order->payment_status = 2;
        $order->save();

        $recurringHistory = RecurringHistory::where('order_id',$order->order_id)->first();

        if($recurringHistory){
            $recurringHistory->status = "Active";
            $recurringHistory->save();
        }

        if($wallet->auto_refill && $wallet->amount < settings('auto_refill_limit')) $this->rechargeWallet($wallet,$user ?? null);

        $response = $this->sendJobRequests($order->id);
        if($response) return $response;
    }

    public function rechargeWallet($wallet,$user = null)
    {
        $charge = $this->stripe->charges->create([
            'amount' => $wallet->auto_refill_amount * 100,
            'currency' => 'usd',
            'customer' => $user ? $user->customer_id : auth()->user()->customer_id,
            'source' => getDefaultCard($user ? $user->id : null)->card_id,
            'description' => $user ? $user->first_name." ".$user->last_name."'s wallet has been auto refilled" :
                auth()->user()->first_name." ".auth()->user()->last_name."'s wallet has been auto refilled",
        ]);

        $wallet->increment('amount',$charge['amount_captured']/100);
    }

    public function makeTransaction($order,$account,$amount,$charge = null,$user_id = null)
    {
        $transaction = new Transaction();
        $transaction->user_id = $user_id ?? Auth::id();
        $transaction->category_id = $order->category_id;
        $transaction->order_id    = $order->id;
        $transaction->transaction_id = $charge ? $charge['id'] : 'Wallet transaction';
        $transaction->amount = $amount;
        $transaction->status = 2;
        $transaction->type = 1;
        $transaction->account = $account;
        $transaction->stripe_response = $charge ? json_encode($charge) : null;
        $transaction->save();
    }

    public function getNextOrderNumber()
    {
        $lastOrder = Order::orderBy('id','desc')->first();

        if(!empty($lastOrder)){
            return 'ORD'.str_pad($lastOrder->id + 1, 12, "0", STR_PAD_LEFT);
        }else{
            return 'ORD'.str_pad(1, 12, "0", STR_PAD_LEFT);
        }
    }

    public function uploadOrderImages($request,$order_id,$order)
    {
        if($request->totalImages > 0){
            for ($x = 0; $x < $request->totalImages; $x++)  {
                if ($request->hasFile('images'.$x)) {
                    $image = $request->file('images'.$x);
                    $foldername = '/uploads/orders/'.$order_id.'/';
                    $filename = time().'-'.rand(00000,99999).'.'.$image->extension();
                    $image->move(public_path().$foldername,$filename);
                    $data['order_id'] = $order->id;
                    $data['image'] = $foldername.$filename;
                    OrderImage::create($data);
                }
            }
        }
    }

    public function orderImagesForApi($request,$order_id,$order)
    {
        $images = $request->file('images');
        foreach ($images as $image) {
            $foldername = '/uploads/orders/'.$order_id.'/';
            $filename = time().'-'.rand(00000,99999).'.'.$image->extension();
            $image->move(public_path().$foldername,$filename);
            $data['order_id'] = $order->id;
            $data['image'] = $foldername.$filename;
            OrderImage::create($data);
        }
    }

    public function sendJobRequests($order_id)
    {
        $favProvidersCount = $this->sendJobRequestsToFavoriteProviders($order_id);
        if($favProvidersCount){
            SendJobRequestsToRemainingProviders::dispatch($order_id)->delay(now()->addMinutes(settings('send_job_requests_to_remaining_providers_after_mins')));
        } else {
            $this->sendJobRequestsToRemainingProvidersWithinRadius($order_id);
        }
    }

    public function sendJobRequestsToFavoriteProviders($order_id)
    {
        $order = Order::find($order_id);
        $favProviders = $this->getFavoriteProviders($order->category_id,$order->user_id);
        foreach($favProviders as $provider){
            $message = "New job is available in your Area!";

            sendNotification(
                $provider->provider_id,
                $order->user_id,
                'New Job Available',
                $message
            );

            $this->sendSms($provider->user->phone_number,$message);
        }
        return count($favProviders);
    }

    public function sendJobRequestsToRemainingProvidersWithinRadius($order_id)
    {
        $order = Order::find($order_id);

        if($order->status == 1){

            $radius = settings('radius');
            $types = [3,$order->category_id];
            $favProviders = $this->getFavoriteProviders($order->category_id,$order->user_id,'arrayOfIds');

            $providers = User::whereNotIn('id',$favProviders)
                    ->whereHas('providerDetails', function ($query) use ($types){
                        $query->whereIn('industry_type',$types);
                    })
                    ->select('phone_number',DB::raw("(6371 * acos(cos(radians(".$order->lat.")) * cos(radians(lat)) * cos(radians(lng) - radians(".$order->lng.")) + sin(radians(".$order->lat.")) * sin(radians(lat)))) * 0.621371 AS distance"))
                    ->having('distance', '<=',$radius)
                    ->orderBy('distance', 'asc')
                    ->get();

            foreach($providers as $provider){

                $message = "New job is available in your Area!";

                sendNotification(
                    $provider->provider_id,
                    $order->user_id,
                    'New Job Available',
                    $message
                );

                $this->sendSms($provider->phone_number,$message);
            }
        }
    }

    public function distanceBetweenTwoLocations($lat1, $lon1, $lat2, $lon2, $unit) {
        
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
          return 0;
        }
        else {
          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;

          if ($unit == "Kilometers") {
            return ($miles * 1.609344);
          } else if ($unit == "Nautical Miles") {
            return ($miles * 0.8684);
          } else {
            return $miles;
          }
        }
    }

    public function getFavoriteProviders($category_id,$user_id,$returnType = null){
        $types = [3,$category_id];
        $query = FavoriteProvider::whereUserId($user_id)->whereHas('user',function($query) use ($types){
            $query->whereHas('providerDetails',function($q) use ($types){
                $q->whereIn('industry_type',$types);
            });
        });
        if($returnType == 'arrayOfIds') return $query->get('provider_id')->toArray();
        return $query->get();
    }

    public function sendSms($phoneNumber,$message)
    {
        dispatch(new SendSms($phoneNumber,$message));
    }
}
