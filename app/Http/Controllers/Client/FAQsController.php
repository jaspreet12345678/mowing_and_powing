<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FAQsController extends ClientBaseController
{
    public function index()
    {
        return view('client.faqs.index');
    }
}
