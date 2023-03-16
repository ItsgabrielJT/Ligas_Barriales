<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'representante']);
        $role3 = Role::create(['name' => 'jugador']);

        Permission::create(['name' => 'dashboard'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'torneo.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'torneo.create'])->syncRoles($role1);
        Permission::create(['name' => 'torneo.update'])->syncRoles($role1);
        Permission::create(['name' => 'torneo.destroy'])->syncRoles($role1);

        Permission::create(['name' => 'plantilla.index'])->syncRoles([$role2]);
        Permission::create(['name' => 'plantilla.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'plantilla.update'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'plantilla.destroy'])->syncRoles([$role1, $role2]);
        
        Permission::create(['name' => 'equipos.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'equipos.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'equipos.update'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'equipos.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'calendario.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'calendario.create'])->syncRoles($role1);
        Permission::create(['name' => 'calendario.update'])->syncRoles($role1);
        Permission::create(['name' => 'calendario.destroy'])->syncRoles($role1);

        Permission::create(['name' => 'estadistica-equipo.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'estadistica-equipo.create'])->syncRoles($role1);
        Permission::create(['name' => 'estadistica-equipo.update'])->syncRoles($role1);
        Permission::create(['name' => 'estadistica-equipo.destroy'])->syncRoles($role1);

        Permission::create(['name' => 'estadistica-jugador.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'estadistica-jugador.create'])->syncRoles($role1);
        Permission::create(['name' => 'estadistica-jugador.update'])->syncRoles($role1);
        Permission::create(['name' => 'estadistica-jugador.destroy'])->syncRoles($role1);     

           
    }
}
