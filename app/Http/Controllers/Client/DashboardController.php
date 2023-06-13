<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends ClientBaseController
{
    public function dashboard(Request $req)
    {
        return view('client.dashboard.index');
    }
}
