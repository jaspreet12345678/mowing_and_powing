<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Faq;

class FAQsController extends ApiBaseController
{
    public function faqs(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), ['type' => 'required']);
            if ($validator->fails()) {return parent::resp(false, 'Validation errors', null, $validator->errors());}

            $faqs = Faq::whereType($req->type)->get();
            return parent::resp(true, "Here are your FAQ's.", $faqs);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }
}
