<?php

namespace App\Http\Controllers\Admin;
use App\Models\FooterScript;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FooterScriptController extends AdminBaseController
{
    public function index(){
      $descriprtion= FooterScript::first();
      return view('admin.footerscript.index',compact('descriprtion'));
    }

    public function storeFooterScrpt(Request $request){
      if($request->id==null){
        FooterScript::create(['description'=>$request->editor1]);
      }
      else{
        FooterScript::where('id',$request->id)->update(['description'=>$request->editor1]);
      }
      
        return redirect()->back()->with('success', 'Footer Script Save Successfully');
    }
}
