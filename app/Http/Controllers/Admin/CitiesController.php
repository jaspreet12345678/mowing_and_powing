<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\CityList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Datatables;
class CitiesController extends AdminBaseController
{

    //Show City datatables
    public function index(Request $request)
    {
       
        if ($request->ajax()) {
            $selected_city=City::all()->pluck('name');
            $data=CityList::whereIn('ID',$selected_city)->with('state','city')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    return $data->CITY;
                })
                ->addColumn('status', function ($data) {
                    if ($data->city->status == 1) {
                        $radio_btn = ' <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>';
                    } else {
                        $radio_btn = '<input type="checkbox" class="custom-control-input" id="customSwitch1">';
                    }
                    return $radio_btn;
                })
                ->addColumn('action', function ($data) {
                    // $btn = "<button data-bs-toggle='modal' data-title='Update City' data-bs-target='#modal-opener' data-url='" . route('admin.cities.view-city', ['id' => $data->id]) . "' class='btn btn-success'>Edit</button>";
                    $btn =  "<button data-url='" . route('admin.cities.delete-city', ['id' => $data->city->id]) . "' id='delete-data' class='btn btn-danger'>Delete</button>
                ";
                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.cities.index');
    }

    //Show Page For Add New City
    public function addCityIndexPage()
    {
        try {
          $city_list=CityList::with('state')->get();
            return view('admin.cities._add_city',compact('city_list'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Store New City
    public function Store(Request $req)
    {
        $req->validate([
            'name' => 'required|max:255',
            'status' => 'required|max:255',
        ]);
       $chk_exist_name =City::where('name',$req->name)->first();
       if(!empty($chk_exist_name)){
        return redirect()->back()->with('error', 'City Already Exist');
       }
        $city_data = [
            'name' => $req->name,
            'status' => $req->status
        ];
        City::create($city_data);
        return redirect()->back()->with('success', 'New City Add Successfully!');
    }

    //Show Page for Edit City
    public function ViewCity($id)
    {

        $city_detail = City::where('id', $id)->first();
        return view('admin.cities._update_city', compact('city_detail'));
    }

    //Update City
    public function updateCity(Request $req)
    {
        $req->validate([
            'name' => 'required|max:255',
            'status' => 'required|max:255',
        ]);

        try {
            City::where('id', $req->city_id)->update([
                'name' => $req->name,
                'status' => $req->status
            ]);
            return redirect()->back()->with('success', ' City Updated  Successfully!');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Delete City
    public function deleteCity($id)
    {
        try {

            City::find($id)->delete();
            session()->flash('success', 'City has been deleted successfully');
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }
}
