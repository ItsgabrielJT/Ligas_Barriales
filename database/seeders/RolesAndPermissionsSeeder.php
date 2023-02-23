<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        //app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        


        // create roles 

        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'invitado']);
        $role3 = Role::create(['name' => 'representante']);
        $role4 = Role::create(['name' => 'jugador']);

        // create permissions
        Permission::create(['name' => 'admin.home'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.torneos.index'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.torneos.create'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.torneos.edit'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.torneos.destroy'])->syncRoles([$role1, $role2, $role3, $role4]);

    }
}
