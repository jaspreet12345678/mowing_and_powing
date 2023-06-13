<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Api\Provider\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingsController extends ApiBaseController
{
    public function ratingAndReview(Request $req, $id)
    {
        try {
            $validator = Validator::make($req->all(), [
                'response_time_rating' => 'required',
                'quality_rating' => 'required',
            ]);
            if ($validator->fails()) { return parent::resp(false, 'Validation errors', null, $validator->errors()); }

            $alreadyRated = Rating::whereOrderId($id)->first();
            if($alreadyRated) return parent::resp(false, 'You have already rated this job');

            $order = Order::find($id);

            $data = $req->all();
            $data['order_id'] = $order->id;
            $data['provider_id'] = $order->assigned_to;
            $data['user_id'] = auth()->user()->id;

            Rating::updateOrCreate(['order_id' => $order->id],$data);

            sendNotification(
                $order->assigned_to,
                auth()->id(),
                'Customer rated your job',
                auth()->user()->first_name." ".auth()->user()->last_name." has rated your job for order # ".$order->order_id
            );

            return parent::resp(true, 'Thanks for your review.');
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server." . $th->getMessage());
        }
    }
}
