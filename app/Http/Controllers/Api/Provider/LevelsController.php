<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelsController extends ApiBaseController
{
    public function getLevels()
    {
        try {
            $data = Level::get()->all();
            return parent::resp(true, "Here are provider levels.", $data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }
}
