<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Appetizers', 'description' => 'Start your meal with our delicious appetizers', 'display_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Main Courses', 'description' => 'Our signature main dishes', 'display_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Desserts', 'description' => 'Sweet endings to your perfect meal', 'display_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beverages', 'description' => 'Refreshing drinks and fine wines', 'display_order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
