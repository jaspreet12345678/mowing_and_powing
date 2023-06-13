<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Datatables;

class FAQsController extends AdminBaseController
{
    public function index(Request $request, $type)
    {

        if ($request->ajax()) {
            $data = Faq::where('type', $type)->latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('question', function ($data) {
                    return $data->question;
                })
                ->addColumn('answer', function ($data) {
                    return ($data->answer);
                })
                ->addColumn('action', function ($data) {
                    $btn = "<button data-bs-toggle='modal' data-title='Update Faq' data-bs-target='#modal-opener' data-url='" . route('admin.faqs.view-faq', ['id' => $data->id]) . "' class='btn btn-success'>Edit</button>";
                    $btn = $btn . "<button data-url='" . route('admin.faqs.delete-faq', ['id' => $data->id]) . "' id='delete-data' class='btn btn-danger'>Delete</button>
                    ";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $faq_type = $type;


        return view('admin.faqs.index', compact('faq_type'));
    }

    public function deleteFaq($id)
    {
        try {

            Faq::find($id)->delete();
            session()->flash('success', 'Faq has been deleted successfully');
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    public function ViewFaq($id)
    {

        $faq_detail = Faq::where('id', $id)->first();
        $faq_type = $faq_detail->type;
        return view('admin.faqs.view', compact('faq_detail', 'faq_type'));
    }

    public function updateFaqDetail(Request $request)
    {

        if ($request->id == null) {
            Faq::create(['question' => $request->question, 'type' => $request->type, 'answer' => $request->editor1]);
            return redirect()->back()->with('success', 'Faq Add Successfully!');
        } else {
            Faq::where('id', $request->id)->update(['question' => $request->question, 'type' => $request->type, 'answer' => $request->editor1]);
            return redirect()->back()->with('success', 'Faq Update Successfully!');
        }
    }

    public function addFaq($type)
    {

        $faq_type = $type;
        return view('admin.faqs.view', compact('faq_type'));
    }
}
