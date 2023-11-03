<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sales>
 */
class SalesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 100),
            'totalPrice' => $this->faker->randomFloat(2, 0, 1000),
            'date' => $this->faker->date(),
            'slug' => Str::slug($this->faker->sentence),
            'product_id' => \App\Models\Products::factory(),
            'person_id' => \App\Models\People::factory(),
        ];
    }
}
