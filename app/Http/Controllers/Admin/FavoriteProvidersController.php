<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FavoriteProvider;

class FavoriteProvidersController extends AdminBaseController
{
    public function index()
    {
        $this->pageTitle = 'Favorite Providers';
        $this->breadCrumbs = ['Providers'];
        $this->providers = FavoriteProvider::whereUserId(auth()->id())->get();
        return view('admin.providers.index',$this->data);
    }

    public function providerDetails(Request $req,$id)
    {
        $this->type = $req->type ?? 'details';
        return view('admin.providers.details',$this->data);
    }
}
