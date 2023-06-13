<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends ClientBaseController
{
   public function privacyPolicy()
   {
        try {

            $this->privacyPolicy = PrivacyPolicy::first();
            return view('client.privacy-policy.index',$this->data);

        } catch (\Throwable $th) {
            abort(500);
        }
   }
}
