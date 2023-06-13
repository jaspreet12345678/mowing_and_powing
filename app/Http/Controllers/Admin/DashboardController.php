<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends AdminBaseController
{

  // Dashboard
  public function dashboard()
  {

    $current_date=today()->format('Y-m-d');
    $this->users=User::latest()->take(5)->get();
    $this->orders=Order::where('payment_status',2)->whereDate('date', '>=', $current_date)->latest()->take(5)->get();
    $this->past_due_job= Order::where('payment_status',2)->whereIn('status',['1','2'])->whereDate('date', '<', $current_date)->latest()->take(5)->get();
    $this->cancel_jobs= Order::where('payment_status',2)->where('status',4)->latest()->take(5)->get();
   //Earning
    $this->paid_by_customer=Transaction::whereStatus(2)->whereType(1)->sum('amount');
    $this->paid_to_provider=Transaction::whereStatus(2)->whereType(2)->sum('amount');
    $this->profit=$this->paid_by_customer-$this->paid_to_provider;
    return view('admin.dashboard.index', $this->data);
  }


  //Filter earning by date(today, last week, last month)
  public function getEarningBYDate($status){
    $current_date=today()->format('Y-m-d');
    $this->users=User::latest()->take(5)->get();
    $this->orders=Order::where('payment_status',2)->whereDate('date', '>=', $current_date)->latest()->take(5)->get();
    $this->past_due_job= Order::where('payment_status',2)->whereIn('status',['1','2'])->whereDate('date', '<', $current_date)->latest()->take(5)->get();
    $this->cancel_jobs= Order::where('payment_status',2)->where('status',4)->latest()->take(5)->get();
    if($status=='today'){
      $today_date=date('Y-m-d');
      $this->paid_by_customer=Transaction::whereStatus(2)->whereType(1)->whereDate('created_at',  $today_date)->sum('amount');
      $this->paid_to_provider=Transaction::whereStatus(2)->whereType(2)->whereDate('created_at',  $today_date)->sum('amount');
    }
    elseif($status=='week'){
      $today_date=date('Y-m-d');
      $week_ago=date('Y-m-d', strtotime('-1 week'));
       $this->paid_by_customer=Transaction::whereStatus(2)->whereType(1)->whereDate('created_at','<=',$today_date)->whereDate('created_at','>=',$week_ago)->sum('amount');
       $this->paid_to_provider=Transaction::whereStatus(2)->whereType(2)->whereDate('created_at','<=',$today_date)->whereDate('created_at','>=',$week_ago)->sum('amount');
    }
    else{
      $today_date=date('Y-m-d');
      $month_ago=date('Y-m-d', strtotime('-1 months'));
       $this->paid_by_customer=Transaction::whereStatus(2)->whereType(1)->whereDate('created_at','<=',$today_date)->whereDate('created_at','>=',$month_ago)->sum('amount');
       $this->paid_to_provider=Transaction::whereStatus(2)->whereType(2)->whereDate('created_at','<=',$today_date)->whereDate('created_at','>=',$month_ago)->sum('amount');
    }

    $this->profit=$this->paid_by_customer-$this->paid_to_provider;
    return view('admin.dashboard.index', $this->data);

  }
}
