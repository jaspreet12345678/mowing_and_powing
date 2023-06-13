<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends ClientBaseController
{
    public function index()
    {
        Notification::whereReceiverId(auth()->id())->update([
            'status' => "1"
        ]);
        $this->allNotifications = Notification::whereReceiverId(auth()->id())->latest()->get();
        return view('client.notifications.index',$this->data);
    }

    public function updateStatus()
    {
        Notification::whereReceiverId(auth()->id())->update([
            'status' => "1"
        ]);
    }
}
