<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Operation>
 */
class OperationFactory extends Factory
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
            'operation_type_id' => \App\Models\OperationType::factory(),
            'box_id' => \App\Models\Box::factory(),
            'user' => \App\Models\User::factory(),

        ];
    }
}
