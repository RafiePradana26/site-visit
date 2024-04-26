<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'user_id' => 1,            
            'akses_halaman' => 'Landing Page, Aktivitas, Pendaftaran, Blog, Kelas, Testimoni, About Us, Role Management, User Management',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('roles')->insert([
            'user_id' => 2,            
            'akses_halaman' => 'Blog',
            'role' => 'writer',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
