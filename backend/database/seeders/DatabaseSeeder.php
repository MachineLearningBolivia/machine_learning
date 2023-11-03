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
        \App\Models\User::factory(50)->create();
        \App\Models\Boxes::factory(50)->create();
        \App\Models\Categories::factory(50)->create();
        \App\Models\Products::factory(50)->create();
        \App\Models\People::factory(50)->create();
        \App\Models\Sales::factory(50)->create();
        \App\Models\OperationTypes::factory(50)->create();
        \App\Models\Operations::factory(50)->create();
        \App\Models\Configurations::factory(50)->create();
    }
}
