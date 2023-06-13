<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $arrayOfPermissionNames = [
            'users',
            'teams',
            'roles_and_permissions',
            'plans',
            'orders',
            'messenger',
            'plugins',
            'calendar',
            'tasks_management',
            'templates',
            'general_settings',
            'site_settings',
            'company_settings',
            'payproviders',
            'cities',
            'promotions',
            'Reports',
            'finance',
            'human_resources',
            'help_center',
            'pay_roll',
            'cms_settings',
        ];

        foreach($arrayOfPermissionNames as $permission){
            Permission::updateOrCreate(['name' => $permission],['name' => $permission, 'guard_name' => 'admin']);
        }

        // Super Admin
        if(!Role::where('name','Super Admin')->first()){
            Role::create(['name' => 'Super Admin','guard_name'=>'admin']);
        }

        if(!Admin::role('Super Admin')->first()){
            Admin::first()->assignRole('Super Admin');
        }

    }
}
