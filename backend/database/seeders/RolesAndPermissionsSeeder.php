<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Basic permissions
        $perms = ['manage_menus', 'manage_reservations', 'manage_orders'];
        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);

        // assign all perms to admin
        $admin->syncPermissions($perms);

        // assign admin role to seeded admin user if exists
        $u = User::where('email', 'admin@savoria.com')->first();
        if ($u) {
            $u->assignRole('admin');
        }
    }
}
