<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\LawnSize;
use App\Models\LawnHeight;
use App\Models\Fence;
use App\Models\Cleanup;
use App\Models\Question;
use App\Models\Faq;
use App\Models\ServicePeriod;
use App\Models\CornerLot;
use App\Models\Admin;
use Datatables;
use DB;



class LawnMovingController extends AdminBaseController
{
    //Showing acrds forlawn sizes
    public function showCards()
    {
        try {
            $fee = ['on_demand_fee', 'tax_rate_lawn', 'admin_feeLawn'];
            $lawnfee = Setting::wherein('field_key', $fee)->get();
            return view('admin.lawnmoving.multi_form', compact('lawnfee'));
            // return view('admin.lawnmoving.index', compact('lawnfee'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    public function updateCharges(Request $request)
    {
        Setting::where('field_key', 'admin_feeLawn')->update(['field_value' => $request->admin_feeLawn]);
        Setting::where('field_key', 'on_demand_fee')->update(['field_value' => $request->on_demand_fee]);
        Setting::where('field_key', 'tax_rate_lawn')->update(['field_value' => $request->tax_rate_lawn]);
        return redirect()->back()->with('success', 'value have been updated Successfully!');
    }
    //get charges of lawn size
    public function getlawmovingfee($type)
    {
        try {
            $fee = Setting::where('field_key', $type)->first();
            return view('admin.lawnmoving._admin_fee', compact('fee'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Edit Lawn Clean Up
    public function editLawnCleanUp($id)
    {
        try {
            $clean_up_data = LawnSize::where('id', $id)->with('cleanUps')->first();
            // return $clean_up_data->cleanUps[0]->price;
            return view('admin.lawnmoving._edit_cleanup', compact('clean_up_data'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }


    //Update Yards Clean Up Prices
    public function updateCleanUp(Request $request)
    {
        try {

            Cleanup::where('id', $request->light_id)->update(['price' => $request->light_cleanup]);
            Cleanup::where('id', $request->heavy_id)->update(['price' => $request->heavy_cleanup]);

            return redirect()->back()->with('success', 'value have been updated Successfully!');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Update Servic Status of Radio
    public function updateServiceStatus($id)
    {
        try {
            $affected = DB::table('service_periods')->update(array('recommended' => 'NO'));
            ServicePeriod::where('id', $id)->update(['recommended' => 'Yes']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Update charges of lawn sizes
    public function feeupdate(Request $request)
    {
        try {
            Setting::where('field_key', $request->key)->update(['field_value' => $request->fee]);
            return redirect()->back()->with('success', 'value have been updated');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Edit questio page
    public function editQuestion($id)
    {
        try {
            $question = Question::where('id', $id)->first();
            return view('admin.lawnmoving._eidt_question', compact('question'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    public function updateLawnMovingQuestion(Request $request)
    {
        try {
            Question::where('id', $request->question_id)->update(['question' => $request->question]);
            return redirect()->back()->with('success', 'Question have been updated');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Show All Cards View by type
    public function lawnSize($type)
    {

        try {
            if ($type == 'lawnsize') {
                $lawn_data = LawnSize::get();
                return $lawn_data;
            } elseif ($type == 'lawnheight') {
                $lawn_data = LawnHeight::get();
                return $lawn_data;
            } elseif ($type == 'fence') {
                $fence_data = Fence::get();
                return $fence_data;
                // return view('admin.lawnmoving.fence');
            } elseif ($type == 'lawn-cleanup') {
                $this->clean_up_data = LawnSize::with('cleanUps')->get();
                return view('admin.lawnmoving._lawncleanup', $this->data);
            } elseif ($type == 'questions') {
                $question_data = Question::where('category', 1)->get();
                return $question_data;
                // return view('admin.lawnmoving.question', compact('question_data'));
            } elseif ($type == 'cornerlot') {
                $corner_data = CornerLot::first();
                return $corner_data;
                // return view('admin.lawnmoving.cornerlot', compact('corner_data'));
            } elseif ($type == 'ServiceDelivery') {
                $this->ServicePeriod = ServicePeriod::get();
               return view('admin.lawnmoving.servicedeilver', $this->data);
                // return view('admin.lawnmoving.servicedeilver', compact('ServicePeriod'));
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Update Corner Lot
    public function updateCornerLot(Request $request)
    {
        try {
            CornerLot::where('id', $request->hidden_id)->update([
                'price' => $request->price,
                'seven_days_price' => $request->seven_days_price,
                'ten_days_price' => $request->ten_days_price,
                'fourteen_days_price' => $request->fourteen_days_price
            ]);
            return redirect()->back()->with('success', 'CornerLot have been updated');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Show Data of Lawn Sizes
    public function getLawndata(Request $request)
    {

        if ($request->ajax()) {
            $data = LawnSize::query();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "<button data-bs-toggle='modal' data-bs-target='#modal-opener' data-url='" . route('admin.generalsettings.lawnmoving.edit-lawn-size', ['id' => $row->id]) . "' class='btn btn-success'>Edit</button>";
                    $btn = $btn . "<button data-url='" . route('admin.generalsettings.lawnmoving.delete-lawn-size', ['id' => $row->id]) . "' id='delete-data' class='btn btn-danger'>Delete</button>
                    ";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return redirect(route('admin.lawnmoving.lawnsize'));
    }
    //show modal for add lawn size
    public function addLwanSize()
    {
        return view('admin.lawnmoving._add_lawnsize');
    }

    //show modal for add lawn height
    public function addLwanHeight()
    {
        return view('admin.lawnmoving._add_lawnheight');
    }

    //Create Lawn Height
    public function addLawnMovingHeight(Request $request)
    {
        try {
            LawnHeight::create($request->except('_token'));
            return redirect()->back()->with('success', 'Lawn height have been add Successfully!');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Create LawnSize
    public function addLawnMovingSize(Request $request)
    {
        try {
            LawnSize::create($request->except('_token'));
            return redirect()->back()->with('success', 'Lawn Size have been add Successfully!');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }
    public function editLawnSize($id)
    {
        try {
            $lawn_size = LawnSize::where('id', $id)->first();
            return view('admin.lawnmoving._edit_lawnsize', compact('lawn_size'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    public function editLawnHeight($id)
    {
        try {
            $lawn_height = LawnHeight::where('id', $id)->first();
            return view('admin.lawnmoving._edit_lawnheight', compact('lawn_height'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }
    public function editFenceData($id)
    {
        try {
            $fence_data = Fence::where('id', $id)->first();
            return view('admin.lawnmoving._edit_fence', compact('fence_data'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Update LawnMoving Height
    public function updateLawnMovingSize(Request $request)
    {
        try {
            LawnSize::where('id', $request->id)->update($request->except('_token'));
            return redirect()->back()->with('success', 'Lawn size have been updated Successfully!');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Update LawnMoving Height
    public function updateLawnMovingHeight(Request $request)
    {
        try {
            LawnHeight::where('id', $request->id)->update($request->except('_token'));
            return redirect()->back()->with('success', 'Lawn Height have been updated Successfully!');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    public function updateFenceData(Request $request)
    {
        try {
            Fence::where('id', $request->id)->update($request->except('_token'));
            return redirect()->back()->with('success', 'Fence Data have been updated Successfully!');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Show Data of Lawn Sizes
    public function getLawnHeightData(Request $request)
    {
        if ($request->ajax()) {
            $data = LawnHeight::query();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = "<button data-bs-toggle='modal' data-bs-target='#modal-opener' data-url='" . route('admin.generalsettings.lawnmoving.edit-lawn-height', ['id' => $row->id]) . "' class='btn btn-success'>Edit</button>";
                    $btn = $btn . "<button data-url='" . route('admin.generalsettings.lawnmoving.delete-lawn-height', ['id' => $row->id]) . "' id='delete-data' class='btn btn-danger'>Delete</button>
                    ";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return redirect(route('admin.lawnmoving.height'));
    }
    //Show Extra Detail about fence
    public function getFenceData(Request $request)
    {
        if ($request->ajax()) {
            $data = Fence::query();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = "<button data-bs-toggle='modal' data-title='Edit Fence' data-bs-target='#modal-opener' data-url='" . route('admin.generalsettings.lawnmoving.edit-fence-data', ['id' => $row->id]) . "' class='btn btn-success'>Edit</button>";
                    $btn = $btn . "<button data-url='" . route('admin.generalsettings.lawnmoving.delete-fence-data', ['id' => $row->id]) . "' id='delete-data' class='btn btn-danger'>Delete</button>
                    ";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return redirect(route('admin.lawnmoving.height'));
    }

    public function deleteFenceData($id)
    {
        try {

            Fence::find($id)->delete();
            session()->flash('success', 'Fence has been deleted successfully');
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }
    //Delete Questions
    public function deleteQuestion($id)
    {
        try {

            Question::find($id)->delete();
            session()->flash('success', 'Question has been deleted successfully');
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }
    //Delete Lawn Size
    public function deleteLawnSize($id)
    {
        try {

            LawnSize::find($id)->delete();
            session()->flash('success', 'LawnSize has been deleted successfully');
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Delete Lawn Height
    public function deleteLawnHeight($id)
    {
        try {
            LawnHeight::find($id)->delete();
            session()->flash('success', 'LawnHeight has been deleted successfully');
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }
}
