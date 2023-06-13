<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertiesController extends ClientBaseController
{
    public function index($type)
    {
        $this->properties = Property::whereCategoryId($type == 'lawn-mowing' ? '1' : '2')->whereUserId(auth()->user()->id)->latest()->get();
         $this->type = $type;
        return view('client.properties.index',$this->data);
    }

    public function deleteProperty($id)
    {
        try {
            $property = Property::find($id);

            if($property->orders->count() === 0){
                $property->delete();
                session()->flash('success','Property deleted successfully');
                return response()->json(['success' => true]);
            }else{
                return response()->json(['success' => false,'message'=>"Property can not be deleted because it is associated with orders"]);
            }


        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

    public function addPropertyIndex($type)
    {
        $this->type = $type;
        return view('client.properties._add-property',$this->data);
    }

    public function addProperty(Request $req,$type)
    {
        $req->validate([
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $data = $req->except('_token');
        $data['category_id'] = $type == 'lawn-mowing' ? '1' : '2';
        $data['user_id'] = auth()->user()->id;

        $property = Property::whereCategoryId($data['category_id'])->whereUserId(auth()->id())->whereLat($data['lat'])->whereLng($data['lng'])->first();
        if($property) return back()->with('error','Property already exists');

        Property::create($data);

        return back()->with('success','Property added successfully');
    }

}
