<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => Hash::make('asasasas'),            
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Marketing',
            'email' => 'marketing@marketing',
            'password' => Hash::make('Marketing#blog'),            
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'writer',
        ]);
    }
}
