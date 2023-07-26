<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name_b = fake()->word();

        return [
            'name_b' => $name_b,
            'slug_b' => Str::slug($name_b),
            'web_b' => fake()->url(),
            'description_b' => fake()->sentence(),
            'visible_b' => fake()->boolean(),
        ];
    }
}
