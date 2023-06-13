<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends ApiBaseController
{
    public function getNotifications()
    {
        try {
            Notification::whereReceiverId(auth()->id())->update([
                'status' => "1"
            ]);
            $this->allNotifications = Notification::whereReceiverId(auth()->id())->latest()->get();

            return parent::resp(true, 'Here are your Notifications.',$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function updateStatus()
    {
        try {
            Notification::whereReceiverId(auth()->id())->update([
                'status' => "1"
            ]);

            return parent::resp(true, 'All notifications marked as read.',$this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function deleteNotification($id)
    {
        try {
            Notification::find($id)->delete();

            return parent::resp(true, 'Notification has been deleted successfully.');
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }
}
