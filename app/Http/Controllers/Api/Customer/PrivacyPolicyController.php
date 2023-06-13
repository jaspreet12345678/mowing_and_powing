<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends ApiBaseController
{
   public function privacyPolicy($type)
   {
    try {
        $data = PrivacyPolicy::whereType($type)->first();
        return parent::resp(true, "Here is Privacy Policy.", $data);
    } catch (\Throwable $th) {
        return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
    }
   }
}
