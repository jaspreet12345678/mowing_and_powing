<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EarningsController extends ApiBaseController
{
    public function totalEarnings()
    {
        try {
            $today = Carbon::now()->format('Y-m-d');
            $week = Carbon::now()->subDays(7);
            $month = Carbon::now()->subMonths(1);

            $this->total_earnings = Transaction::whereProviderId(auth()->user()->id)->whereStatus(2)->whereType(2)->sum('amount');

            $this->today_jobs = Order::with('images','property','period')->whereAssignedTo(auth()->user()->id)->wherePaidToProvider(1)->wherePaymentStatus(2)->whereStatus(3)->whereDate('date',$today)->latest()->get();
            $this->today_earnings = Transaction::whereProviderId(auth()->user()->id)->whereStatus(2)->whereType(2)->whereDate('created_at',$today)->sum('amount');

            $this->week_jobs = Order::with('images','property','period')->whereAssignedTo(auth()->user()->id)->wherePaidToProvider(1)->wherePaymentStatus(2)->whereStatus(3)->whereDate('date','>=', $week)->latest()->get();
            $this->week_earnings = Transaction::whereProviderId(auth()->user()->id)->whereStatus(2)->whereType(2)->whereDate('created_at', '>=', $week)->sum('amount');

            $this->month_jobs = Order::with('images','property','period')->whereAssignedTo(auth()->user()->id)->wherePaidToProvider(1)->wherePaymentStatus(2)->whereStatus(3)->whereDate('date','>=', $month)->latest()->get();
            $this->month_earnings = Transaction::whereProviderId(auth()->user()->id)->whereStatus(2)->whereType(2)->whereDate('created_at','>=', $month)->sum('amount');

            return parent::resp(true, 'Here is your total earning.', $this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }
}
