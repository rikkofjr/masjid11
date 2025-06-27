<?php

namespace Database\Seeders;

use App\Models\ProfileMasjid;
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
        $this->call(BendaharaSeeder::class);
        $this->call(RolesPermissionSeeder::class);
        
       $user =  User::create([
            'username' => 'admin',
            'name' => 'Admin',
            'password' => Hash::make('123456'),
            'email' => 'admin@admin.com',
        ]);
        $user->assignRole('Admin');

        $user1 =  User::create([
            'username' => 'supportadmin',
            'name' => 'Support Admin 1',
            'password' => Hash::make('123456'),
            'email' => 'supportadmin@admin.com',
        ]);
        $user1->assignRole('Support Admin');

        $masjid =  ProfileMasjid::create([
            'nama_masjid' => 'Masjid Al Masjid Dev',
            'alamat_masjid' => 'Jl. Masjid Dev.',
            'no_handphone' => '021-0999039309',
            'is_active' => true,
        ]);
    }
}

