<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id'=>1,
            'name'=>fake()->name(),
            'feature'=>fake()->text(),
            'phones'=>fake()->phoneNumber(),
            'emails'=>fake()->email(),
            'street'=>fake()->address(),
            'image'=>fake()->imageUrl(),
            'google_map_url'=>fake()->url(),
            'latitude'=>fake()->latitude(),
            'longitude'=>fake()->longitude(),

            'available'=>fake()->boolean(),

            'eat_in_place'=>fake()->boolean(),
            'delivery'=>fake()->boolean(),
            'fast_food'=>fake()->boolean(),
        ];
    }
}
