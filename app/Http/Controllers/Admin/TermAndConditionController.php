<?php

namespace App\Http\Controllers\Admin;
use App\Models\TermAndCondition;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TermAndConditionController extends AdminBaseController
{
    //\
    public function index($type){
        $this->descriprtion= TermAndCondition::whereType($type)->first();
        $this->type = $type;
        return view('admin.term-and-condition.index',$this->data);
      }

      public function storeTermAndConditionDetail(Request $request){
        if($request->id==null){
            TermAndCondition::create(['type' => $request->type,'description' => $request->editor1]);
        }
        else{
            TermAndCondition::where('id',$request->id)->update(['description'=>$request->editor1]);
        }
          return redirect()->back()->with('success', 'Terms and Condition Save Successfully');
      }
}
