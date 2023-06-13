<?php

namespace App\Providers;

use App\Models\CompanySetting;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('app.env') === 'production' || config('app.env') === 'staging' || config('app.env') ===  'cooming_soon') {
            // URL::forceScheme('https');
        }

        $company = [];

        if (Schema::hasTable('company_settings')) {
            $company = CompanySetting::first();
        }
        View::share('company',$company);

        Blade::directive('permission', function ($permission) {
            return "<?php if (auth('admin')->user()->hasRole('Super Admin') || auth('admin')->user()->can({$permission})) { ?>";
        });
        Blade::directive('endpermission', function () {
            return '<?php } ?>';
        });
    }
}
