<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermAndCondition;

class TermAndConditionController extends ClientBaseController
{
    public function termsAndConditions()
    {
        try {

            $this->termsAndConditions = TermAndCondition::first();
            return view('client.terms-and-conditions.index',$this->data);

        } catch (\Throwable $th) {
            abort(500);
        }
    }
}
