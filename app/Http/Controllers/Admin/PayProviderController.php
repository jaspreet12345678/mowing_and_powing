<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Datatables;
use App\Models\User;
use App\Traits\OrderTrait;
use App\Models\Transaction;
use App\Models\FavoriteProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayProviderController extends AdminBaseController
{
    use OrderTrait;
    //Show list of pending and in review payments
    public function getProviderByPaymentStatus(Request $request, $status)
    {

        if ($request->ajax()) {
            if ($request->status == 'needpayment') {
                $data = Order::where('payment_status', 2)->where('status', 3)->where('is_reviewed', NULL)->where('paid_to_provider', NULL)->whereNotNull('assigned_to')->get();
            } elseif ($request->status == 'needreview') {
                $data = Order::where('payment_status', 2)->where('status', 3)->where('is_reviewed', 1)->where('paid_to_provider', 0)->whereNotNull('assigned_to')->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('provider', function ($data) {
                    return isset($data->provider->first_name) ? $data->provider->first_name . ' ' . $data->provider->last_name : 'Not Assigned';
                })
                ->addColumn('provideramount', function ($data) {
                    return isset($data->provider_amount) ? '$' . $data->provider_amount : 'Not Assigned';
                })


                ->addColumn('action', function ($data) {
                    $btn = "<button data-bs-toggle='modal' data-bs-target='#modal-opener' data-url='" . route('admin.payproviders.view_payment_approved', ['id' => $data->id]) . "' class='btn btn-success btn-xs'>Approve</button>";
                    $btn = $btn . "<button data-bs-toggle='modal' data-bs-target='#modal-opener' data-url='" . route('admin.payproviders.view_payment_reject', ['id' => $data->id]) . "' class='btn btn-warning btn-xs'>Reject</button>";
                    return $btn;
                })

                ->addColumn('Detail', function ($data) {
                    $btn = "<a  href='" . route('admin.order.view-detail', ['id' => $data->id, 'status' => $data->status]) . "'class='btn btn-primary btn-xs'>See Detail</a>";
                    return $btn;
                })
                ->rawColumns(['action', 'Detail'])
                ->make(true);
        }
        // $total_request = count(Order::where('payment_status', 2)->get());
        $total_approved = count(Order::where('payment_status', 2)->where('status', 3)->where('paid_to_provider', 1)->whereNotNull('assigned_to')->get());
        $total_pending = count(Order::where('payment_status', 2)->where('status', 3)->where('is_reviewed', NULL)->where('paid_to_provider', NULL)->whereNotNull('assigned_to')->get());
        $total_reject = count(Order::where('payment_status', 2)->where('status', 4)->whereNotNull('assigned_to')->get());
        return view('admin.payproviders.index', compact('status', 'total_approved', 'total_pending', 'total_reject'));
    }

    //Show Paid Providers List
    public function getPaidProviders(Request $request, $status)
    {

        if ($request->ajax()) {
            if ($request->status == 'approvedpayment' || $request->status == 'transaction_done') {
                $data = Order::where('payment_status', 2)->where('status', 3)->where('paid_to_provider', 1)->whereNotNull('assigned_to')->get();
            } elseif ($request->status == 'rejectpayment') {
                $data = Order::where('payment_status', 2)->where('status', 4)->whereNotNull('assigned_to')->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('provider', function ($data) {
                    return isset($data->provider->first_name) ? $data->provider->first_name . ' ' . $data->provider->last_name : 'Not Assigned';
                })
                ->addColumn('provideramount', function ($data) {
                    return isset($data->provider_amount) ? '$' . $data->provider_amount : 'Not Assigned';
                })->addColumn('Detail', function ($data) {
                    $btn = "<a  href='" . route('admin.order.view-detail', ['id' => $data->id, 'status' => $data->status]) . "'class='btn btn-primary' style='
                     padding: 6px !important;'>See Detail</a>";
                    if ($data->status == '4') {
                        $btn = $btn . "<button data-bs-toggle='modal' data-bs-target='#modal-opener' data-url='" . route('admin.payproviders.view_payment_approved', ['id' => $data->id]) . "' class='btn btn-success'>Approve</button>";
                    }
                    return $btn;
                })
                ->rawColumns(['Detail'])
                ->make(true);
        }

        $total_approved = count(Order::where('payment_status', 2)->where('status', 3)->where('paid_to_provider', 1)->whereNotNull('assigned_to')->get());
        $total_pending = count(Order::where('payment_status', 2)->where('status', 3)->where('is_reviewed', NULL)->where('paid_to_provider', NULL)->whereNotNull('assigned_to')->get());
        $total_reject = count(Order::where('payment_status', 2)->where('status', 4)->whereNotNull('assigned_to')->get());
        if ($request->status == 'transaction_done') {
            $total_transaction = Order::where('payment_status', 2)->where('status', 3)->where('paid_to_provider', 1)->whereNotNull('assigned_to')->pluck('provider_amount')->sum();
            return view('admin.payproviders.successfull_transaction', compact('status', 'total_transaction'));
        }
        return view('admin.payproviders.paid_provider_list', compact('status', 'total_approved', 'total_pending', 'total_reject'));
    }

    //View Warning for payment approved
    public function viewPaymentApproved($id)
    {
        return view('admin.payproviders._approve_payment', compact('id'));
    }
    //Show Warning for payment reject
    public function viewPaymentReject($id)
    {
        return view('admin.payproviders._reject_payment', compact('id'));
    }
    //payment Approved
    public function paymentApproved($id)
    {
        $order = Order::find($id);
        if(!$order) return redirect()->back()->with('error','Order does not exist');

        if($order->paid_to_provider == 1) {
            return redirect()->back()->with('error', 'Provider has already been paid against this order');
        } elseif (!$order->provider->provider_account_id) {
            return redirect()->back()->with('error', 'Provider does not have a bank account. Kindly ask the provider to add bank details');
        }

        try {
            $account = $this->stripe->accounts->retrieve(
                $order->provider->provider_account_id,
                []
            );

            if($account->payouts_enabled) {
                $transfer = $this->stripe->transfers->create([
                    'amount' => $order->provider_amount * 100,
                    'currency' => 'usd',
                    'destination' => $order->provider->provider_account_id,
                    'transfer_group' => $order->order_id,
                ]);

                Transaction::create([
                    'user_id' => $order->user_id,
                    'provider_id' => $order->assigned_to,
                    'order_id' => $order->id,
                    'transaction_id' => $transfer->id,
                    'amount' => $order->provider_amount,
                    'status' => 2,
                    'type' => 2,
                    'category_id' => $order->category_id,
                    'account' => 'card',
                    'stripe_response' => json_encode($transfer)
                ]);

                $order->paid_to_provider = 1;
                $order->save();
            } else {
                return redirect()->back()->with('error', "Payouts are not enabled on this provider's bank account.");
            }

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Something unexpected happened on server. ".$th->getMessage());
        }

        return redirect()->back()->with('success', 'Payment to Provider Successfully Approved');
    }

    //Rejcetd Payments
    public function paymentReject($id)
    {
        Order::where('id', $id)->update(['status' => 4]);
        return redirect()->back()->with('success', 'Payment to Provider Rejceted Successfully');
    }

    //Payment Review
    public function paymentReview($id)
    {
        Order::where('id', $id)->update(['is_reviewed' => 1]);
        return redirect()->back()->with('success', 'Payment to Provider Successfully in Review');
    }
}
