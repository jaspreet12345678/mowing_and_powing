<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

class AboutUsController extends ClientBaseController
{
    public function index()
    {
        return view('client.about-us.index');
    }
}
