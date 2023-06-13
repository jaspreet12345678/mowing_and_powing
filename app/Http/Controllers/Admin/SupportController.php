<?php

namespace App\Http\Controllers\Admin;

use App\Models\SupportTicket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Datatables;

class SupportController extends AdminBaseController
{
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data = SupportTicket::latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('full_name', function ($data) {
                    return isset($data->user->first_name) ? $data->user->first_name . $data->user->first_name : '';
                })
                ->addColumn('email', function ($data) {
                    return isset($data->user->email) ? $data->user->email : '';
                })
                ->addColumn('phone_number', function ($data) {
                    return isset($data->user->phone_number) ? $data->user->phone_number : '';
                })
                ->addColumn('description', function ($data) {
                    return isset($data->detail) ? $data->detail : '';
                })
                ->addColumn('action', function ($data) {
                    $btn = "<button data-bs-toggle='modal' data-title='Support Description' data-bs-target='#modal-opener' data-url='" . route('admin.support.see-detail', ['id' => $data->id]) . "' class='btn btn-success btn-xs'>Details</button>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.supports.index');
    }

    public function appFlow(){
        return view('admin.supports.app_flow');
    }


    public function seeSupportsDetail($id)
    {
        $supports_description = SupportTicket::where('id', $id)->first();
        return view('admin.supports._show', compact('supports_description'));
    }
}
