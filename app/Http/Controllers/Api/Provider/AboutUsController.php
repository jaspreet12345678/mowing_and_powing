<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends ApiBaseController
{
    public function aboutUs()
    {
        try {
            $data = AboutUs::get()->all();
            return parent::resp(true, "About us.", $data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }
}
