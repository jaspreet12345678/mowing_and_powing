<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Datatables;
use Auth;

class AdminsController extends AdminBaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  return    Admin::with('roles')->orderBy('id')->();
        return view('admin.users.admins.index', $this->data);
    }

    public function editProfile()
    {
        return view('admin.auth.edit-profile');
    }


    public function updateProfile(Request $req)
    {
        $req->validate([
            'name' => 'required|max:255',    
        ]);
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $foldername = '/uploads/admin/profile_pic/';
            $filename = time().'-'.rand(00000,99999).'.'.$image->extension();
            $image->move(public_path().$foldername,$filename);
            Admin::where('id', auth()->id())->update(['image'=> $foldername.$filename]);
        }

        $admin_data = [
            'name' => $req->name,
        ];

        if($req->password){
            $req->validate([
                'password' => 'confirmed', 
            ]);
         $admin_data['password'] = hash::make($req->password);
        }

        Admin::where('id', auth()->id())->update($admin_data);
        return back()->with('success', 'Profile updated');
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
        $this->customer = Admin::find($id);
        return view('admin.users.admins.show', $this->data);
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
        try {

            Admin::find($id)->delete();
            session()->flash('success', 'Admin deleted successfully');
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong! Admin can not be deleted', 'error' => $th->getMessage()]);
        }
    }

    public function data(Request $request)
    {
        if ($request->expectsJson()) {
            return Datatables::of(Admin::with('roles')->orderBy('id'))->make();
        }
        return redirect(route('admin.admins.index'));
    }
}
