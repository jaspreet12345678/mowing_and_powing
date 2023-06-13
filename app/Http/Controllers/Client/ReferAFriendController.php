<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReferAFriendController extends ClientBaseController
{
    public function index()
    {
        return view('client.refer-a-friend.index');
    }

    public function share()
    {
        return view('client.refer-a-friend.share');
    }
}
