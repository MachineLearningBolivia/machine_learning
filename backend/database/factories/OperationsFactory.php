<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Operations>
 */
class OperationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->word;

        return [
            'name' => $name,
            'description' => $this->faker->paragraph,
            'slug' => Str::slug($name),
            'operation_type_id' => \App\Models\OperationTypes::factory(),
            'box_id' => \App\Models\Boxes::factory(),
            'user' =>    \App\Models\User::factory(),

        ];
    }
}
