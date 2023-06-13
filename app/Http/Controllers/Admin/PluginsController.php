<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EnvCredential;
use Illuminate\Support\Facades\Artisan;

class PluginsController extends AdminBaseController
{
    public function index()
    {
        return view('admin.plugins.index');
    }

    public function plugin($plugin)
    {
        $this->env = new \CodeZero\DotEnvUpdater\DotEnvUpdater(base_path() . '/.env');
        return view('admin.plugins._' . $plugin, $this->data);
    }

    public function update(Request $req)
    {

        $env = new \CodeZero\DotEnvUpdater\DotEnvUpdater(base_path() . '/.env');
        $data = $req->except('_token', '_method');

        if (!array_key_exists("STRIPE_LIVE_MODE", $data)) {
            $data['STRIPE_LIVE_MODE'] = '';
        }
        foreach ($data as $key => $value) {
            $env->set($key, $value);
            //set value into database
            EnvCredential::updateOrCreate(
                [
                   'key' => $key,
                ],
                [
                   'value' => $value,
                ],
            );
        }

        Artisan::call('config:clear');
        Artisan::call('queue:restart');

        return redirect()->back()->with('success', 'Credentials have been updated');
    }
}
