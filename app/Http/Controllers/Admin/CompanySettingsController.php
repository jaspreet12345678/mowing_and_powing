<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class CompanySettingsController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->settings = CompanySetting::first();
        return view('admin.company-settings.index',$this->data);
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
        $data = $request->except('_token');
        $company = CompanySetting::updateOrCreate(['id'=>$id],$data);

        if($request->logo){
            $fileName = time().'_'.$request->logo->getClientOriginalName();
            $filePath = $request->file('logo')->move('uploads/company-settings',$fileName);
            $company->logo = '/' . $filePath;
            $company->save();
        }

        if($request->favicon){
            $fileName = time().'_'.$request->favicon->getClientOriginalName();
            $filePath = $request->file('favicon')->move('uploads/company-settings',$fileName);
            $company->favicon = '/' . $filePath;
            $company->save();
        }

        return redirect()->back()->with('success','Settings updated');
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
