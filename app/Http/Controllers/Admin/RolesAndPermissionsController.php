<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Datatables;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsController extends AdminBaseController
{
    public function index()
    {
        return view('admin.roles-and-permissions.index',$this->data);
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
        try {

            Role::create(['name' => $request->role,'guard_name'=>'admin']);
            return redirect()->back()->with('success','Role added successfully');

        } catch (\Throwable $th) {
             return redirect()->back()->with('error','Something went wrong!'.$th->getMessage());
        }
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
        try {

            $this->role = Role::find($id);
            return view('admin.roles-and-permissions._edit-role',$this->data);

        } catch (\Throwable $th) {
             return response()->json(['success'=>false,'message'=>'Something went wrong!','error'=>$th->getMessage()]);
        }
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
        try {

            $role = Role::updateOrCreate(['id'=>$id],['name'=>$request->role]);
            return redirect()->back()->with('success','Role updated successfully');

        } catch (\Throwable $th) {
             return redirect()->back()->with('error','Something went wrong!'.$th->getMessage());
        }
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

            Role::find($id)->delete();
            session()->flash('success', 'Role deleted successfully');
            return response()->json(['success'=>true]);

        } catch (\Throwable $th) {
             return response()->json(['success'=>false,'message'=>'Something went wrong!','error'=>$th->getMessage()]);
        }
    }

    public function data(Request $request)
    {
        if($request->expectsJson()){
            return Datatables::of(Role::where('name','!=','Super Admin')->orderBy('id','desc'))->make();
        }
        return redirect(route('admin.roles-and-permissions.index'));
    }

    public function permissions($role_id)
    {
        try {
            $this->role_id = $role_id;
            $this->allPermissions = Permission::all();
            $this->selectedPermissions = Role::find($role_id)->permissions->pluck('name')->toArray();
            return view('admin.roles-and-permissions._permissions',$this->data);

        } catch (\Throwable $th) {
             return response()->json(['success'=>false,'message'=>'Something went wrong!','error'=>$th->getMessage()]);
        }
    }

    public function updatePermissions(Request $request,$role_id)
    {
        try {
            $this->selectedPermissions = array_keys($request->except('_token','_method'));
            Role::find($role_id)->syncPermissions($this->selectedPermissions);
            return redirect()->back()->with('success','Permissions have been updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Something went wrong! '.$th->getMessage());
        }
    }
}
