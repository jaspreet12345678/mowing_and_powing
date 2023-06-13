<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Datatables;
use Auth;
use App\Models\RecurringHistory;
use App\Models\User;

class RecurringJobsController extends AdminBaseController
{
    //
    public function index(Request $request, $status)
    {
     try{
        if ($request->ajax()) {
            if ($status == 'all') {
                $data = RecurringHistory::query()->latest()->get();
            } else {
                $data = RecurringHistory::where('status', $status)->latest()->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('username', function ($data) {
                    return $data->user->first_name;
                })
                ->addColumn('recurringplan', function ($data) {
                    return 'Every' . ' ' . $data->on_every . ' ' . 'Days';
                })
                ->addColumn('nextservice', function ($data) {
                    return date("m/d/Y", strtotime($data->date));
                })
                ->addColumn('admin_commission', function ($data) {
                    return $data->admin_commission_perc . '%';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $this->status = $status;
        $this->all_jobs = RecurringHistory::count();
        $this->active_jobs = RecurringHistory::where('status', 'Active')->count();
        $this->completed_jobs = RecurringHistory::where('status', 'Completed')->count();
        $this->pending_jobs = RecurringHistory::where('status', 'Pending')->count();
        $this->cancel_jobs = RecurringHistory::where('status', 'Cancel')->count();
        $this->failed_jobs = RecurringHistory::where('status', 'Failed')->count();
        return view('admin.recurring-jobs.index', $this->data);
    }
    catch (\Throwable $th) {
        return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
    }
    }


    public function viewJobDetail($id)
    {
        try{
        $this->jobDetails = RecurringHistory::find($id);
        return view('admin.recurring-jobs.view', $this->data);
        }
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }


    //Show Alert For Cancel Order
    public function cancelJobWarning($id)
    {
        try{
            $this->job = RecurringHistory::find($id);
            return view('admin.recurring-jobs.__cancel', $this->data);
        }
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
       
    }

    public function cancelJob(Request $req)
    {
        try {
            RecurringHistory::where('id', $req->job_id)->update(
                [
                    'status' => 'Cancel',
                    'status_reason' => $req->cancel_reason . '(Cancel by ' . Auth::user()->name . ')',
                ]
            );
            return redirect()->back()->with('success', 'Order has been cancelled');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }


    public function orderList(Request $request, $id)
    {
        try{
        if ($request->ajax()) {
            $data = Order::where('parent_recurring_order_id', $id)->with('user', 'category', 'property', 'provider')->get();
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
                    $btn = "<a  href='" . route('admin.order.view-detail', ['id' => $data->id, 'status' => $data->status]) . "'class='btn btn-primary btn-xs'>See Detail</a>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.recurring-jobs.order_list', compact('id'));
    }
    catch (\Throwable $th) {
        return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
    }
    }
}
