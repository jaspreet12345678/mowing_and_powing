<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Datatables;
use App\Models\User;
use App\Models\FavoriteProvider;
use App\Traits\ChatMessages;
use App\Traits\OrderTrait;
use DB;

class CancelJobsController extends AdminBaseController
{
    use ChatMessages,OrderTrait;

    //All cancel Jobs And Thier Total
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Order::where('payment_status', 2)->where('status', 4)->where('is_refund_reviewed', NULL)->where('is_refunded', NULL)->whereNotNull('assigned_to')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('username', function ($data) {
                    return $data->user->first_name;
                })
                ->addColumn('category', function ($data) {
                    return $data->category->name;
                })
                ->addColumn('provider', function ($data) {
                    return isset($data->provider->first_name) ? $data->provider->first_name : 'Not Assigned';
                })
                ->addColumn('status', function ($data) {
                    return ($data->status == 1) ? 'Pending' : (($data->status == 2) ? 'accepted' : (($data->status == 4) ? 'canceled' : 'completed'));
                })

                ->addColumn('action', function ($data) {
                    $btn = "<a  href='" . route('admin.cancel-jobs.refund', ['id' => $data->id, 'status' => $data->status]) . "'class='btn btn-success btn-pill px-4'>Refund</a>  ";
                    $btn = $btn . "<a  href='" . route('admin.cancel-jobs.review', ['id' => $data->id, 'status' => $data->status]) . "'class='btn btn-secondary btn-pill px-4'>Review</a>";
                    return $btn;
                })
                ->addColumn('Detail', function ($data) {
                    $btn = "<a  href='" . route('admin.order.view-detail', ['id' => $data->id, 'status' => $data->status]) . "'class='btn btn-primary btn-pill px-4'>See Detail</a>";
                    return $btn;
                })
                ->rawColumns(['action','Detail'])
                ->make(true);
        }
        $this->total_cancel = Order::where('payment_status', 2)->where('status', 4)->where('is_refund_reviewed', NULL)->where('is_refunded', NULL)->count();
        $this->refunded = Order::where('payment_status', 2)->where('status', 4)->where('is_refunded', 1)->count();
        $this->under_review = Order::where('payment_status', 2)->where('status', 4)->where('is_refunded', NULL)->where('is_refund_reviewed', 1)->count();
        return view('admin.cancel_jobs.index', $this->data);
    }


    // Refund and review Jobs on base of Status
    public function refundedJobs(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::where('payment_status', 2)->where('status', 4)->where('is_refunded', 1)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('username', function ($data) {
                    return $data->user->first_name;
                })
                ->addColumn('category', function ($data) {
                    return $data->category->name;
                })
                ->addColumn('provider', function ($data) {
                    return isset($data->provider->first_name) ? $data->provider->first_name : 'Not Assigned';
                })
                ->addColumn('status', function ($data) {
                    return ($data->status == 1) ? 'Pending' : (($data->status == 2) ? 'accepted' : (($data->status == 4) ? 'canceled' : 'completed'));
                })

                ->addColumn('action', function ($data) {
                    $btn = "<a  href='" . route('admin.order.view-detail', ['id' => $data->id, 'status' => $data->status]) . "'class='btn btn-primary btn-pill px-4'>See Detail</a>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $this->total_cancel = Order::where('payment_status', 2)->where('status', 4)->where('is_refund_reviewed', NULL)->where('is_refunded', NULL)->count();
        $this->refunded = Order::where('payment_status', 2)->where('status', 4)->where('is_refunded', 1)->count();
        $this->under_review = Order::where('payment_status', 2)->where('status', 4)->where('is_refunded', NULL)->where('is_refund_reviewed', 1)->count();
        return view('admin.cancel_jobs.refunded_jobs',$this->data);
    }


    public function reviewedJobs(Request $request){

        if ($request->ajax()) {
            $data =$data = Order::where('payment_status', 2)->where('status', 4)->where('is_refunded', NULL)->where('is_refund_reviewed', 1)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('username', function ($data) {
                    return $data->user->first_name;
                })
                ->addColumn('category', function ($data) {
                    return $data->category->name;
                })
                ->addColumn('provider', function ($data) {
                    return isset($data->provider->first_name) ? $data->provider->first_name : 'Not Assigned';
                })
                ->addColumn('status', function ($data) {
                    return ($data->status == 1) ? 'Pending' : (($data->status == 2) ? 'accepted' : (($data->status == 4) ? 'canceled' : 'completed'));
                })

                ->addColumn('action', function ($data) {
                    $btn = "<a  href='" . route('admin.cancel-jobs.refund', ['id' => $data->id, 'status' => $data->status]) . "'class='btn btn-success btn-pill px-4'>Refund</a>";
                    return $btn;
                })
                ->addColumn('Detail', function ($data) {
                    $btn = "<a  href='" . route('admin.order.view-detail', ['id' => $data->id, 'status' => $data->status]) . "'class='btn btn-primary btn-pill px-4'>See Detail</a>";
                    return $btn;
                })
                ->rawColumns(['action','Detail'])
                ->make(true);
        }

        $this->total_cancel = Order::where('payment_status', 2)->where('status', 4)->where('is_refund_reviewed', NULL)->where('is_refunded', NULL)->count();
        $this->refunded = Order::where('payment_status', 2)->where('status', 4)->where('is_refunded', 1)->count();
        $this->under_review = Order::where('payment_status', 2)->where('status', 4)->where('is_refunded', NULL)->where('is_refund_reviewed', 1)->count();

        return view('admin.cancel_jobs.reviewed_jobs',$this->data);
    }

    //Update for Refund to user
    public function RefundCancelJob($id)
    {
         Order::where('id', $id)->update(['is_refunded' => 1]);
               $order=Order::where('id',$id)->first();
        $message = "Order # ".$order->order_id." has been refunded.";

        sendNotification(
            $order->user_id,
            auth()->id(),
            'Order refunded',
            $message
        );

        $this->sendSms($order->user->phone_number,$message);
        return redirect()->back()->with('success', 'Refund Successfully!');
    }


    //Show Jobs For Review
    public function ReviewCancelJob($id)
    {
        Order::where('id', $id)->update(['is_refund_reviewed' => 1]);
        return redirect()->back()->with('success', 'Job Going for Review Successfully!');
    }
}
