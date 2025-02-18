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
        //\App\Models\User::factory()->create([
          //  'name' => 'Admin',
            //'surname' => 'User',
            //'role' => 'admin',
            //'email' => 'admin@user.com',
            //'password' => bcrypt('password'),
            //'phone' => '+59176543210',
            //'avatar' => 'URL://user.admin',
            //'status' => 'active',
        //]);

        // \App\Models\User::factory(50)->create();
        // \App\Models\Box::factory(50)->create();
        // \App\Models\Category::factory(50)->create();
        // \App\Models\Product::factory(50)->create();
        // \App\Models\Person::factory(50)->create();
        // \App\Models\Sale::factory(50)->create();
        // \App\Models\OperationType::factory(50)->create();
        // \App\Models\Operation::factory(50)->create();
        // \App\Models\Configuration::factory(50)->create();
        \App\Models\Categoria::factory(1)->create();
        \App\Models\Maquinaria::factory(5)->create();
    }
}
