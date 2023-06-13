<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermAndCondition;

class TermAndConditionController extends ApiBaseController
{
    public function termsAndConditions($type)
    {
        try {
            $data = TermAndCondition::whereType($type)->first();
            return parent::resp(true, "Here are your Terms and Conditions.", $data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }
}
