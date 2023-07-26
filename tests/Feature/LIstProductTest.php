<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Product;
use App\Filament\Resources\ProductResource\Pages\ListProducts;

/**
 * @internal
 */
class LIstProductTest extends TestCase
{
    public function test_list_posts()
    {
        $posts = Product::factory()->count(10)->create();

        Livewire::test(ListProducts::class)
            ->assertCanSeeTableRecords($posts)
        ;
    }

        public function test_render_create_at_post()
        {
            Product::factory()->count(10)->create();

            Livewire::test(ListProducts::class)
                ->assertCanRenderTableColumn('name')
                ->assertCanRenderTableColumn('price')
                ->assertCanRenderTableColumn('sku')
                ->assertCanRenderTableColumn('quantity')
                ->assertCanRenderTableColumn('security')
                ->assertCanRenderTableColumn('is_visible')
                ->assertCanRenderTableColumn('published_at')
            ;
        }

    public function test_search_product_name()
    {
        $product = Product::factory()->count(10)->create();
        $name = $product->first()->name;

        Livewire::test(ListProducts::class)
            ->searchTable($name)
            ->assertCanSeeTableRecords($product->where('name', $name))
            ->assertCanNotSeeTableRecords($product->where('name', '!=', $name))
        ;
    }
}
