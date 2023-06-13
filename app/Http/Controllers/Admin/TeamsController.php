<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TeamInvitation;
use App\Models\Admin;
use App\Models\CompanySetting;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class TeamsController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.teams.index');
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
        try {

            Admin::find($id)->delete();
            session()->flash('success', 'Team member has been deleted successfully');
            return response()->json(['success'=>true]);

        } catch (\Throwable $th) {
             return response()->json(['success'=>false,'message'=>'Something went wrong!','error'=>$th->getMessage()]);
        }
    }

    public function data(Request $request)
    {
        if($request->expectsJson()){
            return DataTables::of(Admin::where('name','!=','Super Admin')->with('roles')->orderBy('id','desc'))->make();
        }
        return redirect(route('admin.teams.index'));
    }

    public function inviteIndex(Request $request)
    {
        if($request->expectsJson()){
            $this->allPermissions = Permission::all();
            $this->roles = Role::where('name','!=','Super Admin')->latest()->get();
            $this->selectedPermissions = Role::find($this->roles[0]->id)->permissions->pluck('name')->toArray();
            return view('admin.teams._invite',$this->data);
        }
        return redirect(route('admin.teams.index'));
    }

    public function permissions($role){
        $this->allPermissions = Permission::all();
        $this->selectedPermissions = Role::where('name',$role)->first()->permissions->pluck('name')->toArray();
        return view('admin.teams._permissions',$this->data);
    }

    public function invite(Request $request)
    {
        try {
            $data = $request->except('_token');

            $admin = Admin::where('email',$request->email)->first();
            $template = EmailTemplate::where('email_type','team-invitation-email')->first();

            if($admin) return redirect()->back()->with('error','This admin has been already registered!');
            if(!$template) return redirect()->back()->with('error','Kindly add the "Team Invitation" email template. From left sidebar => Templates => Email templates => Team Invitation');

            $companyName = CompanySetting::first()->name;
            $url = route('admin.login');
            $data['password'] = base64_encode(openssl_random_pseudo_bytes(30));

            Mail::to($request->email)->send(new TeamInvitation($request->name,$url,$companyName,$request->email,$data['password'],$request->role,$template->content));
            Admin::create($data)->assignRole($request->role);

            return redirect()->back()->with('success','Invitation has been sent');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Something went wrong! '.$th->getMessage());
        }
    }
}
