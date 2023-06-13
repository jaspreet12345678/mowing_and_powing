<?php

namespace App\Http\Controllers\Admin;
use App\Models\AboutUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends AdminBaseController
{
    public function index(){
        $descriprtion= AboutUs::first();
        return view('admin.about-us.index',compact('descriprtion'));
      }
  
      public function storeAbouUsDetail(Request $request){
        if($request->id==null){
            AboutUs::create(['description'=>$request->editor1]);
        }
        else{
            AboutUs::where('id',$request->id)->update(['description'=>$request->editor1]);
        }
        
          return redirect()->back()->with('success', 'About Us Detail Save Successfully');
      }
}
