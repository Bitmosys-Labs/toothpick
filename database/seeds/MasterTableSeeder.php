<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Core_modules\User\Model\User;

class MasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'control_panel',
            'role',
            'permission'
        ];

        $display_name = [
            'Control Panel',
            'Role',
            'Permission'
        ];

        foreach ($permissions as $key=>$permission) {
            Permission::create([
                'name' => $permission,
                'display_name' => $display_name[$key],
                'rank' => ++$key,
            ]);
        }

        $user = User::create([
            'name' => 'Superadmin',
            'username' => 'superadmin',
            'control' => 1,
            'last_visit' => date('Y-m-d H:m:s'),
            'status' => 0,
            'email' => 'superadmin@system.co',
            'password' => Hash::make('password'),
        ]);

        $role = Role::create(['name' => 'administrator']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
