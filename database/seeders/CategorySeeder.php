<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categories::create([
            "name"=> "Electronic",
        ]);
        Categories::create([
            "name"=> "Health",
        ]);
        Categories::create([
            "name"=> "Hobby",
        ]);
    }
}
