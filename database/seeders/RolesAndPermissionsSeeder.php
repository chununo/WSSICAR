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
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);
        $sucursalRole = Role::create(['name' => 'sucursal']);
        $userRole = Role::create(['name' => 'user']);

        $viewSucursalPermission = Permission::create(['name' => 'view_sucursal']);
        $createSucursalPermission = Permission::create(['name' => 'create_sucursal']);
        $editSucursalPermission = Permission::create(['name' => 'edit_sucursal']);
        $deleteSucursalPermission = Permission::create(['name' => 'delete_sucursal']);

        $adminRole->givePermissionTo($viewSucursalPermission);
        $adminRole->givePermissionTo($createSucursalPermission);
        $adminRole->givePermissionTo($editSucursalPermission);
        $adminRole->givePermissionTo($deleteSucursalPermission);

        $editorRole->givePermissionTo($viewSucursalPermission);
        $editorRole->givePermissionTo($editSucursalPermission);

        $userRole->givePermissionTo($viewSucursalPermission);
        $sucursalRole->givePermissionTo($viewSucursalPermission);

    }
}
