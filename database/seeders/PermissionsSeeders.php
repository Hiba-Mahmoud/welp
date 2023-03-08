<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'client']);
        $role1 = Role::create(['name' => 'writer']);


        $role2 = Role::create(['name' => 'admin']);


        $role3 = Role::create(['name' => 'Super-Admin']);



    }
}
