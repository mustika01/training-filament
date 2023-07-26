<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name_c' => fake()->name(),
            'email_c' => fake()->email(),
            'phone_c' => fake()->numberBetween(),
            'born_c' => fake()->dateTime(),

        ];
    }
}
