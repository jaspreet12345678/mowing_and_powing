<?php

namespace App\Console\Commands;

use App\Models\Card;
use App\Models\Order;
use App\Models\OrderImage;
use App\Models\RecurringHistory;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\OrderTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckRecurringJobs extends Command
{
    use OrderTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurring:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to check the recurring jobs to make an order';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Checking Recurring Jobs');
        $this->checkRecurringJobs();
        return Command::SUCCESS;
    }

    private function checkRecurringJobs()
    {
        try {
            $todayDate = Carbon::now()->addDay()->format('Y/m/d');

            $recurringJobs = RecurringHistory::whereStatus('active')->whereDate('date',$todayDate)->get();

            if (count($recurringJobs)) {

                $stripe = new \Stripe\StripeClient(config('stripe.LIVE_MODE') ? config('stripe.LIVE_SECRET_KEY') : config('stripe.TEST_SECRET_KEY'));

                foreach ($recurringJobs as $recurringJob) {
                    try {
                        $newOrderId = $this->getNextOrderNumber();
                        $lastOrder = Order::whereOrderId($recurringJob->order_id)->first();
                        $defaultCard = Card::whereUserId($recurringJob->user_id)->whereIsDefault('1')->first();
                        $user = User::find($recurringJob->user_id);
                        $wallet = Wallet::whereUserId($user->id)->first();
                        $account = '';

                        if($wallet->amount > $recurringJob->grand_total) {
                            $wallet->amount = $wallet->amount - $recurringJob->grand_total;
                            $wallet->save();
                            $account = 'wallet';
                        }else {
                            $account = 'both';
                            $exceedingAmount = $recurringJob->grand_total - $wallet->amount;

                            if(!$defaultCard) {
                                $message = 'Kindly add your default card as a payment method for recurring job';

                                sendNotification(
                                    $user->id,
                                    0,
                                    'Problem in recurring job',
                                    $message
                                );

                                $this->sendSms($user->phone_number,$message);

                                continue;
                            }

                            try {
                                $charge = $stripe->charges->create([
                                    'amount' => $exceedingAmount * 100,
                                    'currency' => 'usd',
                                    'source' => $defaultCard->card_id,
                                    'description' => $user->first_name.' '.$user->last_name.' was charged for Lawn Mowing order (Exceeding charges) (Recurring job)',
                                    'customer' => $user->customer_id,
                                    'metadata' => [
                                        'user_id' => $user->id,
                                        'order_id' => $newOrderId,
                                        'recurring_history_id' => $recurringJob->id
                                    ],
                                ]);

                                if(!$charge) throw new \ErrorException('Your card was declined.');

                            } catch (\Throwable $th) {

                                sendNotification(
                                    $user->id,
                                    0,
                                    'Problem in recurring job',
                                    $th->getMessage()
                                );

                                $this->sendSms($user->phone_number,$th->getMessage());

                                continue;
                            }
                        }

                        $order = new Order();
                        $order->order_id = $newOrderId;
                        $order->user_id = $recurringJob->user_id;
                        $order->category_id = $recurringJob->category_id;
                        $order->property_id = $recurringJob->property_id;
                        $order->lat = $recurringJob->lat;
                        $order->lng = $recurringJob->lng;
                        $order->date = $todayDate;
                        $order->on_demand = 'Schedule';
                        $order->lawn_size_id = $recurringJob->lawn_size_id;
                        $order->lawn_size_amount = $recurringJob->lawn_size_amount;
                        $order->fence_id = $recurringJob->fence_id;
                        $order->fence_amount = $recurringJob->fence_amount;
                        $order->corner_lot_id = $recurringJob->corner_lot_id;
                        $order->corner_lot_amount = $recurringJob->corner_lot_amount;
                        $order->service_period_id = $lastOrder->service_period_id;
                        $order->service_type = 2;
                        $order->gate_code = $recurringJob->gate_code;
                        $order->instructions = $recurringJob->instructions;
                        $order->admin_fee = $recurringJob->admin_fee;
                        $order->total_amount_by_provider = $recurringJob->total_amount_by_provider;
                        $order->total_amount = $recurringJob->total_amount;
                        $order->tax_perc = $recurringJob->tax_perc;
                        $order->tax = $recurringJob->tax;
                        $order->tip_type = $lastOrder->tip_type;
                        $order->tip_perc = $lastOrder->tip_perc;
                        $order->tip = $recurringJob->tip;
                        $order->admin_commission_perc = $recurringJob->admin_commission_perc;
                        $remainingTotal = $order->total_amount - $order->admin_fee;
                        $order->admin_commission = $order->admin_commission_perc / 100 * $remainingTotal;
                        $order->grand_total = $recurringJob->grand_total;
                        $order->provider_amount = $remainingTotal - $order->admin_commission;
                        $order->payment_status = 2;
                        $order->parent_recurring_order_id = $recurringJob->id;
                        $order->status = 1;
                        $order->save();

                        $orderImages = OrderImage::whereOrderId($lastOrder->id)->get();

                        foreach($orderImages as $image){
                            OrderImage::create([
                                'order_id' => $order->id,
                                'image' => $image->image,
                            ]);
                        }

                        $recurringJob->order_id = $order->order_id;
                        $recurringJob->date = Carbon::parse($recurringJob->date)->addDays($recurringJob->on_every);
                        $recurringJob->save();

                        if($account == 'wallet'){
                            $this->makeTransaction($user,$order,'wallet',$recurringJob->grand_total);
                        } else {
                            $this->makeTransaction($user,$order,'card',$charge->amount / 100,$charge);
                            if($exceedingAmount != $recurringJob->grand_total) $this->makeTransaction($user,$order,'wallet',$wallet->amount);
                            $wallet->amount = 0;
                            $wallet->save();
                        }

                        try {
                            if($wallet->auto_refill && $wallet->amount < settings('auto_refill_limit')) $this->rechargeWallet($stripe,$wallet,$user,$defaultCard,$recurringJob,$newOrderId);
                        } catch (\Throwable $th) {
                            Log::error('Error in CheckRecurringJobs command in cron job: Unable to auto refill wallet: '.$th->getMessage());
                        }

                        $this->sendJobRequests($order->id);

                    } catch (\Throwable $th) {
                        Log::error('Error in CheckRecurringJobs command in cron job: '.$th->getMessage());
                    }
                }
            }
        } catch (\Throwable $th) {
            Log::error('Error in CheckRecurringJobs command in cron job: '.$th->getMessage());
        }
    }

    private function rechargeWallet($stripe,$wallet,$user,$defaultCard,$recurringJob,$newOrderId)
    {
        $charge = $stripe->charges->create([
            'amount' => $wallet->auto_refill_amount * 100,
            'currency' => 'usd',
            'customer' => $user->customer_id,
            'source' => $defaultCard->card_id,
            'description' => $user->first_name." ".$user->last_name."'s wallet has been auto refilled (Recurring job)",
            'metadata' => [
                'user_id' => $user->id,
                'order_id' => $newOrderId,
                'recurring_history_id' => $recurringJob->id
            ],
        ]);

        $wallet->increment('amount',$charge['amount_captured']/100);

        sendNotification(
            $user->id,
            0,
            'Wallet refilled',
            "Your M&P wallet is automatically refilled"
        );
    }

    private function makeTransaction($user,$order,$account,$amount,$charge = null)
    {
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
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

}

