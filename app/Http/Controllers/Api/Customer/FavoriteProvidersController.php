<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FavoriteProvider;

class FavoriteProvidersController extends ApiBaseController
{
    public function favoriteProviders()
    {
        try {
           $favoriteProviders = FavoriteProvider::with('user')->whereUserId(auth()->user()->id)->get();
            return parent::resp(true, 'Here are your favorite providers.', $favoriteProviders);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }
}
