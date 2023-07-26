<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->word();
        $price = fake()->randomFloat(2, 1, 100);
        $barcode = fake()->ean8();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => 'loremipsumdolorsitamet',
            'price' => $price,
            'old_price' => fake()->randomFloat(2, 1, 100),
            'cost' => fake()->randomFloat(2, 1, 100),
            'sku' => fake()->randomNumber(8, true),
            'barcode' => $barcode,
            'quantity' => fake()->randomNumber(3, false),
            'security' => fake()->randomNumber(3, false),
            'is_visible' => fake()->boolean(),
            'published_at' => fake()->dateTime(),
            'brand_id' => Brand::factory(),

        ];
    }
}
