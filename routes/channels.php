<?php

use App\Models\Order;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('order-live-chat.{id}', function ($user,$id) {
    $customer = Order::whereId($id)->whereUserId($user->id)->first();
    $provider = Order::whereId($id)->whereAssignedTo($user->id)->first();
    return $customer || $provider ? true : false;
});

Broadcast::channel('notifications.{receiver_id}', function ($user,$receiver_id) {
    return (int) $user->id === (int) $receiver_id;
});
