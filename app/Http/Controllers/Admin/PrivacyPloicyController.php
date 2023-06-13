<?php

namespace App\Http\Controllers\Admin;
use App\Models\PrivacyPolicy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrivacyPloicyController extends AdminBaseController
{
    //
    public function index($type){
        $this->descriprtion = PrivacyPolicy::where('type', $type)->first();
        $this->type = $type;
        return view('admin.privacy-policy.index',$this->data);
      }

      public function storePrivacyDetail(Request $request){
        if($request->id==null){
            PrivacyPolicy::create(['type' => $request->type,'description'=>$request->editor1]);
        }
        else{
            PrivacyPolicy::where('id',$request->id)->update(['description'=>$request->editor1]);
        }
          return redirect()->back()->with('success', 'Privacy Ploicy Detail Save Successfully');
      }
}
