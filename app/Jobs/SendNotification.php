<?php

namespace App\Jobs;

use App\Events\NewNotification;
use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $receiver_id,$sender_id,$title,$content;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($receiver_id,$sender_id,$title,$content)
    {
        $this->receiver_id = $receiver_id;
        $this->sender_id = $sender_id;
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $notification = Notification::create([
                'receiver_id' => $this->receiver_id,
                'sender_id' => $this->sender_id,
                'title' => $this->title,
                'content' => $this->content
            ]);
            broadcast(new NewNotification($notification))->toOthers();
        } catch (\Throwable $th) {
            Log::error('Error in sendNotification function: '.$th->getMessage());
        }
    }
}
