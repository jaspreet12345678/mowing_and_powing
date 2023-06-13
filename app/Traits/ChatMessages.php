<?php

namespace App\Traits;

use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

trait ChatMessages {

    public function sendChatMessage(Request $req)
    {
        $message = auth()->user()->messages()->create([
            'order_id' => $req->order_id,
            'user_id' => auth()->id(),
            'message' => $req->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();
    }
}
