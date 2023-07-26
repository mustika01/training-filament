<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = Product::factory()
            // ->image()
            ->count(5)
            ->create()
        ;

        $products->each(function ($product) {
            $category = Category::inRandomOrder()->first();

            $product->categories()->sync([
                $category->id,
            ]);
        });
    }
}
