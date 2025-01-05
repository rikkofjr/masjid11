<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       $user =  User::create([
            'username' => 'admin',
            'name' => 'Admin',
            'password' => Hash::make('123456'),
            'email' => 'admin@admin.com',
        ]);

        $role = Role::create(['name' => 'Admin']);
        $permissionAdminPanel = Permission::create(['name' => 'Access Admin Panel']);
        $permissionManageUser = Permission::create(['name' => 'Manage : User']);
        $user->assignRole($role);
        $role->givePermissionTo($permissionAdminPanel);
        $role->givePermissionTo($permissionManageUser);

        $user1 =  User::create([
            'username' => 'supportadmin',
            'name' => 'Support Admin 1',
            'password' => Hash::make('123456'),
            'email' => 'supportadmin@admin.com',
        ]);
        $role1 = Role::create(['name' => 'Support Admin']);
        $user1->assignRole($role1);
        $role1->givePermissionTo($permissionAdminPanel);

        //Ambil seeder tempat lain
        $this->call(BendaharaSeeder::class);
    }
}

