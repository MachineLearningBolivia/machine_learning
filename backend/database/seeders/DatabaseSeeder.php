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
        \App\Models\User::factory()->create([
            'name' => 'Matt Logan',
            'surname' => 'Tahuasi Pariamo',
            'role' => 'Administrador',
            'email' => 'mattahuasi@gmail.com',
            'password' => 'holamundo',
            'phone' => '+59176543210',
            'avatar' => 'URL://user.admin',
            'status' => 'Active',
        ]);

        \App\Models\User::factory(50)->create();
        \App\Models\Box::factory(50)->create();
        \App\Models\Category::factory(50)->create();
        \App\Models\Product::factory(50)->create();
        \App\Models\Person::factory(50)->create();
        \App\Models\Sale::factory(50)->create();
        \App\Models\OperationType::factory(50)->create();
        \App\Models\Operation::factory(50)->create();
        \App\Models\Configuration::factory(50)->create();
    }
}
