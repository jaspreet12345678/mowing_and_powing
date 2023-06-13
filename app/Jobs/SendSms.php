<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $phoneNumber,$message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phoneNumber,$message)
    {
        $this->phoneNumber = $phoneNumber;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            // Log::info("Sent message '".$this->message." @ Mowing and Plowing' on ".$this->phoneNumber);
            if(config('services.sms_service') == 'messagebird'){
                $MessageBird = new \MessageBird\Client(config('services.message_bird.key'));
                $Message = new \MessageBird\Objects\Message();
                $Message->originator = "Secure";
                $Message->recipients = [$this->phoneNumber];
                $Message->body = $this->message." @ Mowing and Plowing";
                $MessageBird->messages->create($Message);
            }else {
                $sid = config('services.twilio.account_sid');
                $token = config('services.twilio.auth_token');
                $twilio = new Client($sid, $token);
                $twilio->messages->create($this->phoneNumber, // to
                    ["body" => $this->message." @ Mowing and Plowing", "from" => config('services.twilio.from')]
                );
            }

        } catch (\Throwable $th) {
            Log::error("In SendSms job: ".$th->getMessage());
        }
    }
}
