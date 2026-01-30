<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsSeeder extends Seeder
{
    public function run()
    {
        DB::table('menu_items')->insert([
            ['category_id' => 2, 'name' => 'Grilled Sea Bass', 'description' => 'Fresh Mediterranean sea bass with herbs and lemon butter sauce', 'price' => 42.00, 'is_featured' => true, 'display_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'name' => 'Prime Ribeye Steak', 'description' => '28-day aged beef with roasted vegetables and red wine jus', 'price' => 56.00, 'is_featured' => true, 'display_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 3, 'name' => 'Chocolate Symphony', 'description' => 'Dark chocolate mousse with berry compote and gold leaf', 'price' => 18.00, 'is_featured' => true, 'display_order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
