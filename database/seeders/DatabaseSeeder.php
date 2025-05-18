<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Product::factory(10)->create();
        echo '~~~~~~~~~~~~~~~~/ __ \ _____  ___
               / / / // ___/\/ _ \
              / /_/ // /  __/  __/ 
             /_____//_/\___/\___/~~~~~~~~~~~~~~~~' . PHP_EOL;


        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'email' => 'andrew@gmail.com',
            'role_id' => 1
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Gamer',
            'username' => 'gamer',
            'password' => bcrypt('gamer123'),
            'email' => 'gamer1@gmail.com',
            'role_id' => 2
        ]);

        \App\Models\UserData::create([
            'user_id' => 1
        ]);
        \App\Models\UserData::create([
            'user_id' => 2
        ]);
        \App\Models\Role::factory()->create([
            'name' => 'Admin',
        ]);
        \App\Models\Role::factory()->create([
            'name' => 'Customer',
        ]);

        // array_map('unlink', array_filter((array) glob("public/uploads/product/*")));
        // array_map('unlink', array_filter((array) glob("public/uploads/user-avatar/*")));
        // array_map('unlink', array_filter((array) glob("public/uploads/payment/*")));

        // \App\Models\Product::factory(25)->create();
        // \App\Models\Attachment::factory(25)->create();


        echo PHP_EOL . "SEEDING SUCCESS!!";
    }
}
