<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'packages.view',
            'packages.manage',
            'leads.view',
            'leads.manage',
            'applications.view',
            'applications.manage',
            'payments.manage',
            'clients.view_sensitive',
            'users.manage',
            'settings.manage',
        ];

        foreach ($permissions as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions($permissions);

        $managerPerms = array_diff($permissions, ['users.manage', 'settings.manage']);
        $manager = Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'web']);
        $manager->syncPermissions($managerPerms);

        $staffPerms = [
            'packages.view',
            'leads.view',
            'leads.manage',
            'applications.view',
            'applications.manage',
        ];
        $staff = Role::firstOrCreate(['name' => 'staff', 'guard_name' => 'web']);
        $staff->syncPermissions($staffPerms);

        if ($adminUser = User::where('email', 'admin@travelagency.test')->first()) {
            $adminUser->syncRoles(['admin']);
        }

        if ($staffUser = User::where('email', 'staff@travelagency.test')->first()) {
            $staffUser->syncRoles(['staff']);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
