<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class PropertiesController extends ApiBaseController
{
    public function getProperties(Request $req)
    {
        try {
            $this->properties = Property::withCount('orders')->whereUserId(auth()->user()->id)->latest()->get();
            return parent::resp(true, 'Properties successfully returned', $this->properties);

        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function addProperties(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'address' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'category_id' => 'required',
            ]);
            if ($validator->fails()) { return parent::resp(false, 'Validation errors', null, $validator->errors()); }

            $data = $request->all();
            $data['user_id'] = auth()->user()->id;

            $property = Property::whereCategoryId($data['category_id'])->whereUserId(auth()->id())->whereLat($data['lat'])->whereLng('lng')->first();
            if($property) { return parent::resp(false,'Property already exists');}

            $data = Property::create($data);

            return parent::resp(true, 'Property has been added successfully.', $data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server." . $th->getMessage());
        }
    }

    public function deleteProperty($id)
    {
        try {
           $property = Property::find($id);
            if ($property->orders->count() === 0) {
                $property->delete();
                return parent::resp(true, 'Property has been deleted successfully.');
            }else {
                return parent::resp(true, 'You cannot delete this property.');
            }

        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }


}
