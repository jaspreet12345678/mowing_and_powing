<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponCodeController extends  AdminBaseController
{
    //Showing All Coupon Cards
    public function index()
    {
        try{
        $coupon_data = Coupon::all();
        return view('admin.coupons.index', compact('coupon_data'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Showing Page for Adding New Coupon
    public function addNewCoupon(){
        try{
            return view('admin.coupons._add_new_coupon');
            }catch (\Throwable $th) {
                return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
            }  
    }

    public function storeCouponCode(Request $request){
        try{
        if($request->perc_discount != NULL){
            Coupon::create([
                'name'=>$request->name,
                'type'=>$request->type,
                'discount'=>$request->perc_discount,
                'service'=>$request->service,
                'description'=>$request->description,
                'valid_till'=>$request->valid_till
            ]);
        }
        else{
            Coupon::create($request->except('_token'));
        }
       
        return redirect()->back()->with('success', 'New Coupon Added Successfully!');
        }catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }
    //Show Edit coupn page
    public function editCoupon($id)
    {
        try{
        $update_coupon = Coupon::where('id', $id)->first();
        return view('admin.coupons._edit_coupon', compact('update_coupon'));
        }catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    public function UpdateCouponCode(Request $request)
    {
        
        try{
        if($request->perc_discount==NULL){
            Coupon::where('id', $request->hidden_id)->update($request->except('_token', 'hidden_id','perc_discount'));
        }
        else{
    
            Coupon::where('id', $request->hidden_id)->update([
                'name'=>$request->name,
                'type'=>$request->type,
                'discount'=>$request->perc_discount,
                'service'=>$request->service,
                'description'=>$request->description,
                'valid_till'=>$request->valid_till,
            ]);
        }
        
        return redirect()->back()->with('success', 'Coupon Code updatre Successfully!');
        }catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //show warning page of delete Coupon
    public function couponDeleteWarning($id)
    {
        try{
        $this->job = Coupon::find($id);
        return view('admin.coupons._delete_coupon', $this->data);
        }catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    public function Delete($id){
        try {

            Coupon::find($id)->delete();
            return redirect()->back()->with('success', 'Coupon Code Deleted Successfully!');
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }
}
