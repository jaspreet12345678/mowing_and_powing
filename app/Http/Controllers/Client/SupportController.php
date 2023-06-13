<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportController extends ClientBaseController
{
    public function index()
    {
        return view('client.support.index');
    }

    public function createSupportTicket(Request $req)
    {
        $req->validate([
            'detail' => 'required',
        ]);

        auth()->user()->ticket()->create([
            'user_id' => auth()->id(),
            'detail' => $req->detail
        ]);

        return redirect()->back()->with('success','Support ticket has been generated');
    }
}
