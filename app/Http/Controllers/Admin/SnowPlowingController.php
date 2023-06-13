<?php

namespace App\Http\Controllers\Admin;

use App\Models\SnowDepth;
use App\Models\Setting;
use App\Models\Question;
use App\Models\Color;
use App\Models\SubCategory;
use App\Models\Driveway;
use App\Models\Walkway;
use App\Models\Sidewalk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SnowPlowingController extends AdminBaseController
{
    //Showing All Cards
    public function showCards()
    {
        try {

            $fee = ['tax_rate_snow', 'admin_feeSnow'];
            // $this->driverway = Driveway::get();
            // $this->home_sidewalk = Sidewalk::where('type', 'HOME')->get();
            // $this->business_sidewalk = Sidewalk::where('type', 'business')->get();
            // $this->home_walkway = Walkway::where('type', 'HOME')->get();
            // $this->business_walkway = Walkway::where('type', 'business')->get();
            $this->snowfee = Setting::wherein('field_key', $fee)->get();

            return view('admin.generalsettings.snowplowing.multi_form', $this->data);
            // return view('admin.generalsettings.snowplowing.index', $this->data);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    public function updateCharges(Request $request)
    {
        Setting::where('field_key', 'admin_feeSnow')->update(['field_value' => $request->admin_snowfee]);
        Setting::where('field_key', 'tax_rate_snow')->update(['field_value' => $request->texrate_snow]);
        return redirect()->back()->with('success', 'Snow Plowing Charges Detail have been updated Successfully!');
    }

    public function snowSetting($type)
    {
        try {
            $fee = Setting::where('field_key', $type)->first();
            return view('admin.lawnmoving._admin_fee', compact('fee'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Showing All Cards Value by Type againts every card
    public function GetCardsValueByType($type)
    {
       
        try {
            if ($type == 'question') {
                return  $snow_question = Question::where('category', 2)->get();
                // return view('admin.generalsettings.snowplowing.question', compact('snow_question'));
            } elseif ($type == 'colors') {
                return  $car_colors = Color::get();
                // return view('admin.generalsettings.snowplowing.car_colors', compact('car_colors'));
            } elseif ($type == 'cartype') {
                $car_types = SubCategory::get();
                return $car_types;
                // return view('admin.generalsettings.snowplowing.car_types', compact('car_types'));
            } elseif ($type == 'driveway') {
                $driverway = Driveway::get();
                return $driverway;
            }
            elseif($type=='snowdepth'){
                $snow_depth=SnowDepth::get();
                return $snow_depth;
            }
            elseif ($type == 'sidewalk') {
                $side_walk = Sidewalk::orderBy('type', 'desc')->get();
                return $side_walk;
            } elseif ($type = 'walkway') {
                $walk_way = Walkway::orderBy('type', 'desc')->get();
                return $walk_way;
            }
            
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }


    //View Page for questions
    public function addQuestion()
    {
        try {
            return view('admin.generalsettings.snowplowing._eidt_question');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Edit Page Snow Plowing question
    public function editQuestion($id)
    {
        try {
            $question = question::where('id', $id)->first();
            return view('admin.generalsettings.snowplowing._eidt_question', compact('question'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Create Snow Plowing question
    public function addSnowPlowingQuestion(Request $request)
    {

        try {
            question::create($request->except('_token'));
            return redirect()->back()->with('success', 'Question have been created');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Update Snow Plowing question
    public function updateSnowPlowingQuestion(Request $request)
    {
        try {
            question::where('id', $request->question_id)->update(['question' => $request->question]);
            return redirect()->back()->with('success', 'Question have been updated');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Edit Car Colors
    public function editCarColor($id)
    {
        try {
            $color = Color::where('id', $id)->first();
            return view('admin.generalsettings.snowplowing._eidt_car_color', compact('color'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Show page for store new car color
    public function viewCarColor()
    {
        return view('admin.generalsettings.snowplowing._eidt_car_color');
    }

    //Show page for store new car color
    public function viewCarType()
    {
        return view('admin.generalsettings.snowplowing._eidt_car_type');
    }

    public function addCarColor(Request $request)
    {
        try {
            Color::create($request->except('_token'));
            return redirect()->back()->with('success', 'Question have been created');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    public function addCarType(Request $request)
    {
        try {
            SubCategory::create($request->except('_token'));
            return redirect()->back()->with('success', 'Car Type have been created');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Update Car Color
    public function updateCarColor(Request $request)
    {
        try {
            $color = Color::where('id', $request->hidden_id)->update(['name' => $request->name, 'color_code' => $request->color_code]);
            return redirect()->back()->with('success', 'Color have been updated');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Update Car Type
    public function updateCarType(Request $request)
    {
        try {
            $color = SubCategory::where('id', $request->car_id)->update(['name' => $request->name, 'price' => $request->price]);
            return redirect()->back()->with('success', 'Car Type have been updated');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    public function editCarType($id)
    {
        try {
            $cartype = SubCategory::where('id', $id)->first();
            return view('admin.generalsettings.snowplowing._eidt_car_type', compact('cartype'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Show Griverway Price
    public function getDriverWay($id)
    {
        try {
            $drive_way_data = Driveway::where('id', $id)->first();
            return view('admin.generalsettings.snowplowing._edit_driveway', compact('drive_way_data'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Update Drive Way Price
    public function updateDriverWay(Request $request)
    {
        try {
            Driveway::where('id', $request->id)->update(['on_first_6_cars' => $request->on_first_6_cars, 'on_more_than_6_cars' => $request->on_more_than_6_cars]);
            return redirect()->back()->with('success', 'Price have been updated');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Show Side way price and name
    public function getSideWalk($id)
    {
        try {
            $side_walk_data = Sidewalk::where('id', $id)->first();
            return view('admin.generalsettings.snowplowing._edit_sideway', compact('side_walk_data'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }
    //Update Side walk
    public function updateSideWalk(Request $request)
    {

        try {
            Sidewalk::where('id', $request->id)->update(['price' => $request->price]);
            return redirect()->back()->with('success', 'Price have been updated');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    public function getWalkWay($id)
    {
        try {
            $walk_way_data = Walkway::where('id', $id)->first();
            return view('admin.generalsettings.snowplowing._edit_walkway', compact('walk_way_data'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    public function getSnowDepth($id){
        try {
            $snow_depth = SnowDepth::where('id', $id)->first();
            return view('admin.generalsettings.snowplowing._edit_snow_depth', compact('snow_depth'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
   
    }

    public function updateWalkWay(Request $request)
    {
        try {
            Walkway::where('id', $request->id)->update(['price' => $request->price]);
            return redirect()->back()->with('success', 'Price have been updated');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    public function updateSnowDepth(Request $req){
        try {
            SnowDepth::where('id', $req->id)->update(['price' => $req->price]);
            return redirect()->back()->with('success', 'SnowDepth price has been updated successfully!');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Delete CarType
    public function DeleteCarType($id)
    {
        try {

            SubCategory::find($id)->delete();
            session()->flash('success', 'Car Type has been deleted successfully');
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Delete Car Color
    public function DeleteCarColor($id)
    {
        try {

            Color::find($id)->delete();
            session()->flash('success', 'Color has been deleted successfully');
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Dlete Questions
    public function DeleteQuestuion($id)
    {
        try {
            question::find($id)->delete();
            session()->flash('success', 'Question has been deleted successfully');
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }
}
