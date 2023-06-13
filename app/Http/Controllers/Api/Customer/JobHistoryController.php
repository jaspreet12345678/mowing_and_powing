<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\FavoriteProvider;
use App\Models\Proposal;
use App\Models\Rating;
use App\Models\Transaction;
use App\Traits\ChatMessages;
use App\Traits\OrderTrait;

use Illuminate\Support\Facades\Validator;

class JobHistoryController extends ApiBaseController
{
    use ChatMessages,OrderTrait;

    public function jobs($type)
    {
        try {
            $this->jobs = Order::whereUserId(auth()->id())->where('payment_status',2)->whereStatus($type == 'upcoming-jobs' ? 1 : ($type == 'ongoing-jobs' ? 2 : ($type == 'completed-jobs' ? 3 : 4)))->latest()->with('property','period','images','provider','rating')->get();
            $this->cancelJobFee = settings('cancel_job_charges');

            return parent::resp(true, 'Here are '. $type .'.',$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function jobsDetails($id)
    {
        try {
            $this->jobDetails = Order::with('provider','images','beforeImages','afterImages','rating')->find($id);

            return parent::resp(true, 'Here is your job detail.',$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function cancelJob($id)
    {
        try {
            $order = Order::find($id);
            if($order->on_the_way) return parent::resp(false, 'Order can not be cancelled because provider is on the way.');
            $order->status = 4;
            $order->cancel_order_date = now();
            $order->cancel_reason = 'Canceled by '.auth()->user()->first_name." ".auth()->user()->last_name." (Customer)";
            $order->cancellation_charges = $order->assigned_to ? settings('cancel_job_charges') : null;
            $order->save();

            if($order->assigned_to) {

                $message = "Order # ".$order->order_id." has been cancelled by ".auth()->user()->first_name." ".auth()->user()->last_name." (Customer)";

                sendNotification(
                    $order->assigned_to,
                    auth()->id(),
                    'Order cancelled',
                    $message
                );

                $this->sendSms($order->provider->phone_number,$message);
            }

            return parent::resp(true, 'Order has been cancelled.');
        } catch (\Throwable $th) {
           return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }

    }

    public function upcomingJobsProposals(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), ['order_id' => 'required']);
            if ($validator->fails()) {return parent::resp(false, 'Validation errors', null, $validator->errors());}

            $this->proposals = Proposal::whereOrderId($req->order_id)->with('provider')->get();

            return parent::resp(true, 'Here are proposals for this job.',$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function acceptProposal(Request $req, $id)
    {
        try {
            $proposal = Proposal::find($id);
            $order = Order::find($proposal->order_id);
            $order['assigned_to'] = $proposal->provider_id;
            $order['provider_assigned_date'] = now();
            $order['status'] = 2;
            $order->save();

            Proposal::whereOrderId($proposal->order_id)->delete();

            $message = 'Your proposal has been accepted for order # '.$order->order_id;

            sendNotification(
                $order->assigned_to,
                auth()->id(),
                'Proposal accepted',
                $message
            );

            $this->sendSms($proposal->user->phone_number,$message);

            return parent::resp(true, 'Proposal has been accepted successfully.',$order);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function declineProposal(Request $req, $id)
    {
        try {
            $proposal = Proposal::find($id);
            $proposal->delete();

            sendNotification(
                $proposal->provider_id,
                auth()->id(),
                'Proposal cancelled',
                "Your proposal for order # ".$proposal->order->order_id." has been cancelled by ".auth()->user()->first_name." ".auth()->user()->last_name." (Customer)"
            );

            return parent::resp(true, 'Proposal has been deleted successfully.');
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function ongoingJobsDetails($id)
    {
        $this->job = Order::with('images','provider','rating')->find($id);
        return parent::resp(true, 'Here are Ongoing-jobs detail.',$this->data);
    }

    public function providerLastLocation($id)
    {
        $this->provider = User::with('providerLastLocation')->select(['id','image'])->find($id);
        return parent::resp(true, 'Here is provider last known location.',$this->data);
    }

    public function toggleFavoriteProvider($id)
    {
        try {
            $favoriteProvider = FavoriteProvider::whereProviderId($id)->first();

            if(!$favoriteProvider){
                FavoriteProvider::create(['user_id'=>auth()->id(),'provider_id'=>$id]);
                $message = 'Favorite provider has been added';
            }else{
                $favoriteProvider->delete();
                $message = 'Favorite provider has been removed';
            }

            return parent::resp(true, $message);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function providerDetails(Request $req,$id)
    {
        try {
            $this->providerDetail = User::find($id);
            $this->level = getProviderLevel($id);
            $this->calculateAllRatings($id);

            return parent::resp(true, 'Here is provider detail.',$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function customersChat($order_id)
    {
        try {
            $order = Order::whereId($order_id)->whereUserId(auth()->id())->first();
            if(!$order) return parent::resp(false, "You do not have access to this chat");
            $this->order_id = $order->order_id;
            $this->provider = $order->provider()->select(['id','first_name','last_name','image'])->first();
            $this->messages = ChatMessage::whereOrderId($order_id)->get();

            return parent::resp(true, "Chat returned successfully" ,$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }

    }

    public function sendMessage(Request $req)
    {
        $this->sendChatMessage($req);

        sendNotification(
            $req->provider_id,
            auth()->id(),
            "New message on order # ".$req->order_no,
            $req->message
        );

        return parent::resp(true, 'Message sent');
    }

    public function calculateAllRatings($provider_id)
    {
        $this->totalScore = 0;
        $this->qualityRatingPerc = 0;
        $this->responseOnTimePerc = 0;
        $this->completeJobsPerc = 0;
        $this->cancelJobsPerc = 0;
        $totalRatingsCount = Rating::whereProviderId($provider_id)->count();
        $totalJobs = Order::whereAssignedTo($provider_id)->wherePaymentStatus(2)->whereIn('status',[2,3,4])->count();

        if ($totalRatingsCount) {
            $sumOfQualityRatings = Rating::whereProviderId($provider_id)->sum('quality_rating');
            $qualityRating = $sumOfQualityRatings / $totalRatingsCount;

            $sumOfResponseOnTimeRatings = Rating::whereProviderId($provider_id)->sum('response_time_rating');
            $responseOnTimeRating = $sumOfResponseOnTimeRatings / $totalRatingsCount;

            $this->responseOnTimePerc = ($responseOnTimeRating / 5) * 100;
            $this->qualityRatingPerc = ($qualityRating / 5) * 100;
            $this->totalScore = ($this->responseOnTimePerc + $this->qualityRatingPerc) / 2;
        }

        if ($totalJobs) {
            $completedJobs = Order::whereAssignedTo($provider_id)->wherePaymentStatus(2)->whereStatus(3)->latest()->count();
            $this->completeJobsPerc = ($completedJobs / $totalJobs) * 100;

            $canceledJobs = Order::whereAssignedTo($provider_id)->wherePaymentStatus(2)->whereStatus(4)->latest()->count();
            $this->cancelJobsPerc = ($canceledJobs / $totalJobs) * 100;
        }
    }
    public function updateInstructions(Request $req,$id)
    {
        $validator = Validator::make($req->all(), ['instructions' => 'required']);
        if ($validator->fails()) {return parent::resp(false, 'Validation errors', null, $validator->errors());}

        $order = Order::whereId($id)->whereUserId(auth()->id())->first();
        if(!$order) return parent::resp(false, "Order does not exist");

        $order->instructions = $req->instructions;
        $order->save();

        return parent::resp(true, "Instructions updated successfully");
    }


    public function markJobAsCompleted($id)
    {
        $order = Order::whereId($id)->whereUserId(auth()->id())->wherePaymentStatus(2)->first();
        if(!$order) return parent::resp(false, "Order does not exist");

        if($order->paid_to_provider != 1 && $order->provider->provider_account_id) {
            
            try {
                $account = $this->stripe->accounts->retrieve(
                    $order->provider->provider_account_id,
                    []
                );

                if($account->payouts_enabled) {
                    $transfer = $this->stripe->transfers->create([
                        'amount' => $order->provider_amount * 100,
                        'currency' => 'usd',
                        'destination' => $order->provider->provider_account_id,
                        'transfer_group' => $order->order_id,
                    ]);

                    Transaction::create([
                        'user_id' => $order->user_id,
                        'provider_id' => $order->assigned_to,
                        'order_id' => $order->id,
                        'transaction_id' => $transfer->id,
                        'amount' => $order->provider_amount,
                        'status' => 2,
                        'type' => 2,
                        'category_id' => $order->category_id,
                        'account' => 'card',
                        'stripe_response' => json_encode($transfer)
                    ]);

                    $order->paid_to_provider = 1;
                }

            } catch (\Throwable $th) {
                // dd($th);
            }
        }

        $order->status_by_customer = 1;
        $order->save();

        return parent::resp(true,'Order marked as completed');
    }
}

