<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'beds' => fake()->numberBetween(1, 7),
            'baths' => fake()->numberBetween(1, 7),
            'area' => fake()->numberBetween(30, 400),
            'city' => fake()->city(),
            'code' => fake()->postcode(),
            'street' => fake()->streetName(),
            'street_nr' => fake()->numberBetween(10, 200),
            'price' => fake()->numberBetween(50_000, 2_000_000)
        ];
    }
}
