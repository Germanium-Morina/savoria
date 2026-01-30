<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@savoria.com',
            // existing bcrypt hash from original schema.sql
            'password' => '$2y$10$swlzkynPBQCAk5JVAtkuw.Am99iL2FQND3yd6uf0Fqyap5xXAV51K',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
