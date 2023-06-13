<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupportController extends ApiBaseController
{
    public function customerSupportTicket(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), ['detail' => 'required']);
            if ($validator->fails()) {return parent::resp(false, 'Validation errors', null, $validator->errors());}

            $data = $req->all();
            $data['user_id'] = auth()->user()->id;
            SupportTicket::create($data);

            return parent::resp(true, 'Your request has been received. Kindly wait for response.');
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }
}
