<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Http\Controllers\Controller;
use DB;
use Datatables;
use Illuminate\Http\Request;

class RefferalController extends AdminBaseController
{
    public function index(Request $request){
        // return $data = User::where('status', 1)->whereNotNull('referred_by')->with('reffer')->latest()->get();
        if ($request->ajax()) {
                 $data = User::where('status', 1)->whereNotNull('referred_by')->with('reffer')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('username', function ($data) {
                    return $data->first_name.' '.$data->last_name;
                })
                ->addColumn('email', function ($data) {
                    return $data->email;
                })
                ->addColumn('referred_by', function ($data) {
                    
                    return $data->reffer->first_name.' '.$data->reffer->first_name;
                })
                ->addColumn('status', function ($data) {
                    return ($data->status == 1) ? 'Pending' : (($data->status == 2) ? 'accepted' : (($data->status == 4) ? 'canceled' : 'completed'));
                })

                ->addColumn('action', function ($data) {
                    $btn = "<a  href='" . route('admin.users.customers.show', ['id' => $data->id]) . "'class='btn btn-primary btn-pill px-6'>See Detail</a>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
           return view('admin.refferal_system.index');   
    }  
}
