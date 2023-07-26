<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Product;
use Filament\Pages\Actions\EditAction;
use App\Filament\Resources\ProductResource\Pages\EditProduct;
use App\Filament\Resources\ProductResource\Pages\ListProducts;

/**
 * @internal
 */
class EditProductTest extends TestCase
{
    public function test_render_page()
    {
        $product = Product::factory()->create();

        Livewire::test(EditProduct::class, [
            'record' => $product->getKey(),
        ])
            ->assertSuccessful()
        ;
    }

    public function test_update_product()
    {
        $product = Product::factory()->create();
        $newData = Product::factory()->make();
        $published_date = $newData->published_at->setTime(0, 0, 0);

        Livewire::test(EditProduct::class, [
            'record' => $product->getKey(),
        ])->assertFormSet([
            'name' => $product->name,
            'slug' => $product->slug,
            'description' => $product->description,
            'price' => $product->price,
            'old_price' => $product->old_price,
            'cost' => $product->cost,
            'sku' => $product->sku,
            'barcode' => $product->barcode,
            'quantity' => $product->quantity,
            'security' => $product->security,
            'is_visible' => $product->is_visible,
            'published_at' => $product->published_at,
        ])
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->slug,
                'description' => $newData->description,
                'price' => $newData->price,
                'old_price' => $newData->old_price,
                'cost' => $newData->cost,
                'sku' => $newData->sku,
                'barcode' => $newData->barcode,
                'quantity' => $newData->quantity,
                'security' => $newData->security,
                'is_visible' => $newData->is_visible,
                'published_at' => $published_date,
            ])
            ->call('save')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(Product::class, [
            'id' => $product->getKey(),
            'name' => $newData->name,
            'slug' => $newData->slug,
            'description' => $newData->description,
            'price' => $newData->price,
            'old_price' => $newData->old_price,
            'cost' => $newData->cost,
            'sku' => $newData->sku,
            'barcode' => $newData->barcode,
            'quantity' => $newData->quantity,
            'security' => $newData->security,
            'is_visible' => $newData->is_visible,
            'published_at' => $published_date,
        ]);
    }

    public function test_validate_product_edit_data_name()
    {
        $product = Product::factory()->create();

        LIvewire::test(ListProducts::class)
            ->callTableAction(EditAction::class, $product, data: [
                'name' => null,
            ])
            ->assertHasTableActionErrors(['name' => ['required']])
        ;
    }

    public function test_validate_product_edit_data_slug()
    {
        $product = Product::factory()->create();

        LIvewire::test(ListProducts::class)
            ->callTableAction(EditAction::class, $product, data: [
                'slug' => null,
            ])
            ->assertHasTableActionErrors(['slug' => ['required']])
        ;
    }

    public function test_validate_product_edit_data_price()
    {
        $product = Product::factory()->create();

        LIvewire::test(ListProducts::class)
            ->callTableAction(EditAction::class, $product, data: [
                'price' => null,
            ])
            ->assertHasTableActionErrors(['price' => ['required']])
        ;
    }

    public function test_validate_product_edit_data_oldprice()
    {
        $product = Product::factory()->create();

        LIvewire::test(ListProducts::class)
            ->callTableAction(EditAction::class, $product, data: [
                'old_price' => null,
            ])
            ->assertHasTableActionErrors(['old_price' => ['required']])
        ;
    }

    public function test_validate_product_edit_data_cost()
    {
        $product = Product::factory()->create();

        LIvewire::test(ListProducts::class)
            ->callTableAction(EditAction::class, $product, data: [
                'cost' => null,
            ])
            ->assertHasTableActionErrors(['cost' => ['required']])
        ;
    }

    public function test_validate_product_edit_data_sku()
    {
        $product = Product::factory()->create();

        LIvewire::test(ListProducts::class)
            ->callTableAction(EditAction::class, $product, data: [
                'sku' => null,
            ])
            ->assertHasTableActionErrors(['sku' => ['required']])
        ;
    }

    public function test_validate_product_edit_data_quantity()
    {
        $product = Product::factory()->create();

        LIvewire::test(ListProducts::class)
            ->callTableAction(EditAction::class, $product, data: [
                'quantity' => null,
            ])
            ->assertHasTableActionErrors(['quantity' => ['required']])
        ;
    }

    public function test_validate_product_edit_data_barcode()
    {
        $product = Product::factory()->create();

        LIvewire::test(ListProducts::class)
            ->callTableAction(EditAction::class, $product, data: [
                'barcode' => null,
            ])
            ->assertHasTableActionErrors(['barcode' => ['required']])
        ;
    }

    public function test_validate_product_edit_data_security()
    {
        $product = Product::factory()->create();

        LIvewire::test(ListProducts::class)
            ->callTableAction(EditAction::class, $product, data: [
                'security' => null,
            ])
            ->assertHasTableActionErrors(['security' => ['required']])
        ;
    }

    public function test_validate_product_edit_data_published_at()
    {
        $product = Product::factory()->create();

        LIvewire::test(ListProducts::class)
            ->callTableAction(EditAction::class, $product, data: [
                'published_at' => null,
            ])
            ->assertHasTableActionErrors(['published_at' => ['required']])
        ;
    }
}
