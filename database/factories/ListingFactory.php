<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
            'title' => fake()->sentence(),
            'email' => fake()->safeEmail(),
            'description' => fake()->paragraph(),
            'tags' => 'Laravel, PHP, MySQL',
            'company' => fake()->name(),
            'location' => fake()->city(),
            'website' => fake()->url(),
            'status' => True
        ];
    }

}
