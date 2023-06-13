<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\RecurringHistory;
use Illuminate\Http\Request;

class RecurringJobsController extends ClientBaseController
{
    public function index()
    {
        $this->jobs = RecurringHistory::whereUserId(auth()->id())->latest()->get();
        return view('client.recurring-jobs.index',$this->data);
    }

    public function show($id)
    {
        $this->jobDetails = RecurringHistory::find($id);
        return view('client.recurring-jobs.show',$this->data);
    }

    public function cancelWarning($id)
    {
        $this->job = RecurringHistory::find($id);
        return view('client.recurring-jobs.__cancel',$this->data);
    }

    public function cancel($id)
    {
        $job = RecurringHistory::find($id);
        $job->status = 'Cancel';
        $job->save();

        return back()->with('success','Recurring job has been canceled');
    }

}
