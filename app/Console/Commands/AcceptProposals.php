<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Proposal;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Traits\OrderTrait;
use Illuminate\Support\Facades\Log;

class AcceptProposals extends Command
{
    use OrderTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proposals:accept';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to automatically accept the proposals from providers';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            Log::info('Automatically accepting proposals');
            $now = Carbon::now()->subMinutes(settings('auto_accept_proposal_after_mins'));
            $date = Carbon::parse($now)->toDateString();
            $time = Carbon::parse($now)->toTimeString();

            $proposals = Proposal::whereHas('order',function($query) use($date,$time){
                $query->whereStatus(1)
                    ->whereDate('created_at','<=',$date)
                    ->whereTime('created_at','<=',$time);
            })->get()->groupBy('order_id');
            
            foreach ($proposals as $proposal) {
                $order = Order::find($proposal[0]->order_id);
                $order->assigned_to = $proposal[0]->provider_id;
                $order->provider_assigned_date  = Carbon::now();
                $order->status  = 2;
                $order->save();

                Proposal::whereOrderId($proposal[0]->order_id)->delete();

                $message = 'Your proposal has been accepted on order # '.$order->order_id;

                sendNotification(
                    $order->assigned_to,
                    auth()->id(),
                    'Proposal accepted',
                    $message
                );

                $this->sendSms($proposal[0]->user->phone_number,$message);
            }

        } catch (\Throwable $th) {
            Log::error('Error in AcceptProposals command in cron job: '.$th->getMessage());
        }
    }
}
