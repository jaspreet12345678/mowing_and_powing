<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderImageByProvider;
use Datatables;
use App\Traits\OrderTrait;
use App\Models\User;
use App\Models\FavoriteProvider;
use DB;


class OrdersController extends AdminBaseController
{
    use OrderTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Show Tables of All Orders
    public function index(Request $request,$status)
    {
       $current_date=today()->format('Y-m-d');
        if ($request->ajax()) {

            if($status=='all'){
                
                $data = Order::with('user','provider','category')->where('payment_status', 2)->latest()->get();
            }
            elseif($status=='past_due_order'){
              $data=Order::where('payment_status',2)->whereIn('status',['1','2'])->where('date', '<', $current_date)->get();
            }
            elseif($status=='1' || $status=='2'){
                $data = Order::with('user','provider','category')->where('payment_status', 2)->where('status',$status)->where('date', '>=', $current_date)->latest()->get();
            }
            else{
                $data = Order::with('user','provider','category')->where('payment_status', 2)->where('status',$status)->latest()->get();
            }
           
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
                    $btn = "<a  href='" . route('admin.order.view-detail', ['id' => $data->id, 'status' => $data->status]) . "'class='btn btn-primary btn-pill px-6'>See Detail</a>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $this->status=$status;
        $this->total_orders = Order::where('payment_status', 2)->count();
        $this->accept_orders = Order::where('payment_status', 2)->where('status', 2)->count();
        $this->complete_orders = Order::where('payment_status', 2)->where('status', 3)->count();
        $this->pending_orders = Order::where('payment_status', 2)->where('status', 1)->where('date', '>=', $current_date)->count();
        $this->cancel_orders = Order::where('payment_status', 2)->where('status', 4)->count();
        $this->past_due_job= Order::where('payment_status',2)->whereIn('status',['1','2'])->where('date', '<', $current_date)->count();       
        return view('admin.orders.index', $this->data);
    }

    //View Orders Details
    public function viewDetail($id, $status)
    {
        $this->jobDetails = Order::find($id);
        return view('admin.orders.view_orders', $this->data);
    }

    // Show Modal For Upload Image Against order by Admin
    public function uploadBeforeServiceImage($order_id, $provider_id, $type)
    {
        return view('admin.orders._upload_before_images', compact('order_id', 'provider_id', 'type'));
    }

    //Upload Provider Image By Admin against Order
    public function uploadProviderImages(Request $request)
    {
        $request->validate([
            'images' => 'required',
        ]);
        foreach ($request->images as $image) {
            $foldername = '/uploads/order-images-by-provider/' . $request->type . '/';
            $filename = time() . '-' . rand(00000, 99999) . '.' . $image->extension();
            $image->move(public_path() . $foldername, $filename);
            OrderImageByProvider::create(['order_id' => $request->order_id, 'image' => $foldername . $filename, 'type' => $request->type]);
        }
        return back()->with('success', 'Images Upload Successfully');
    }


    //View Proposal of upcoming jobs
    public function upcomingJobsProposals()
    {
        $this->pageTitle = 'Proposals';
        $this->breadCrumbs = ['Job History', 'Upcoming Jobs', 'Proposals'];
        $this->providers = User::whereType('provider')->get();
        $this->favorites = FavoriteProvider::whereUserId(auth()->id())->pluck('provider_id')->toArray();
        return view('admin.providers.index', $this->data);
    }

    //Show Alert For Cancel Order
    public function cancelJobWarning($id)
    {
        $this->job = Order::find($id);
        return view('admin.orders.__cancel', $this->data);
    }



    //Cnacle Order
    public function cancelJob($id)
    {
        try {
            $order = Order::find($id);
            $order->status = 4;
            $order->save();
            return redirect()->back()->with('success', 'Order has been cancelled');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    // Repost Job
    public function rePostJob($id)
    {
        try {
            Order::where('id', $id)->update(['status' => 1, 'at_location_and_started_job_date' => NULL, 'finished_job_date' => NULL, 'on_the_way_date' => NULL, 'finished_job' => NULL, 'at_location_and_started_job' => NULL, 'assigned_to' => NULL, 'provider_assigned_date' => NULL, 'change_provider_assigned_date' => NULL]);
            $this->sendJobRequests($id);
            return redirect()->back()->with('success', 'Job have been RePost Successfully!');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Show Warning moda; for Repost Job
    public function rePostJobWarning($id)
    {
        $this->job = Order::find($id);
        return view('admin.orders._repost', $this->data);
    }

    //Show Warning for Remove Provider
    public function removeProviderWarning($id)
    {
        $this->job = Order::find($id);
        return view('admin.orders._remove_provider', $this->data);
    }


    // Remove Provider from Job
    public function RemoveProvider($id)
    {
        try {
            Order::where('id', $id)->update(['status' => 1, 'assigned_to' => NULL, 'provider_assigned_date' => NULL,]);
            return redirect()->back()->with('success', 'Provider Remove Successfully!');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }


    //Change Order Reached Status
    public function changeOrderStatus(Request $request)
    {
        try {
          $assign_to=Order::where('id',$request->order_id)->first()->assigned_to;
          if(empty($assign_to)){
           return redirect()->back()->with('error','Please assign provider first');
          }
          else{
            if ($request->status == 'on_the_way') {
                Order::where('id', $request->order_id)->update(['on_the_way' => 1, 'on_the_way_date' => now(), 'at_location_and_started_job' => NULL, 'at_location_and_started_job_date' => NUll, 'finished_job' => NULL, 'finished_job_date' => NULL, 'status' => 2]);
            } elseif ($request->status == 'at_location' || $request->status == 'started_job') {
                Order::where('id', $request->order_id)->update(['on_the_way' => 1, 'on_the_way_date' => now(), 'at_location_and_started_job' => 1, 'at_location_and_started_job_date' => now(), 'finished_job' => NULL, 'finished_job_date' => NULL, 'status' => 2]);
            } elseif ($request->status == 'finished_job') {
                Order::where('id', $request->order_id)->update(['on_the_way' => 1, 'on_the_way_date' => now(), 'at_location_and_started_job' => 1, 'at_location_and_started_job_date' => now(), 'finished_job' => 1, 'finished_job_date' => now(), 'status' => 3]);
            } else {
                return redirect()->back()->with('success', 'Please Select Status First');
            }
            return redirect()->back()->with('success', 'Job Status Change Successfully! ');
        }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
        
    }


    //Update Customer Instructions By Admin
    public function updateCustomerInstruction(Request $request)
    {
        try {

            Order::where('id', $request->hidden_id)->update(['instructions' => $request->instruction]);
            return redirect()->back()->with('success', 'instructions Update Successfully! ');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }


    // Assign Favoriate Provider 
    public function assignProvider($id)
    {
        try {
            $order = Order::find($id);
            $radius = settings('radius');
            $types = [3, $order->category_id];
            $favProviders = $this->getFavoriteProviders($order->category_id, $order->user_id, 'arrayOfIds');
            $this->provider = User::whereHas('providerDetails', function ($query) use ($types) {
                $query->whereIn('industry_type', $types);
            })->select('first_name', 'id', 'last_name', DB::raw("(6371 * acos(cos(radians(" . $order->lat . ")) * cos(radians(lat)) * cos(radians(lng) - radians(" . $order->lng . ")) + sin(radians(" . $order->lat . ")) * sin(radians(lat)))) * 0.621371 AS distance"))
                ->having('distance', '<=', $radius)
                ->orderBy('distance', 'asc')
                ->get();

            $this->order_id = $id;
            // $this->provider = User::where('type', 'provider')->get();
            return view('admin.orders._assign_list', $this->data);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Assign Provuider to Order
    public function updateAssignProvider(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'provider' => 'required'
        ]);
        try {

            Order::where('id', $request->order_id)->update(['assigned_to' => $request->provider, 'provider_assigned_date' => now(), 'status' => 2]);
            return redirect()->back()->with('success', 'Provider Assign Successfully! ');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
