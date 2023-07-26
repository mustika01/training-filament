<?php

namespace Tests\Feature;

use App\Filament\Resources\BrandResource\RelationManagers\ProductsRelationManager;
use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Filament\Resources\ProductResource;
use App\Filament\Resources\ProductResource\Pages\CreateProduct;
use App\Models\Category;

/**
 * @internal
 */
class CreateProductTest extends TestCase
{
    public function test_render_create_product_page()
    {
        Livewire::test(CreateProduct::class)
            ->assertSuccessful()
        ;
    }

    public function test_create_post()
    {
        $newData = Product::factory()->make();
        $published_date = $newData->published_at->setTime(0, 0, 0);
        

        Livewire::test(CreateProduct::class)
            ->fillForm([
                'name' => $newData->name,
                'slug' => Str::slug($newData->name),
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
                'category_id' => $newData->category_id,
                'brand_id' => $newData->brand_id,
            ])
            ->call('create')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(Product::class, [
            'name' => $newData->name,
            'slug' => $newData->name,
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
            'category_id' => $newData->category_id,
            'brand_id' => $newData->brand_id,
        ]);


    }

    public function test_validate_input_product_null_name()
    {
        $newData = Product::factory()->make();

        Livewire::test(CreateProduct::class)
            ->fillForm([
                'name' => null,
                'slug' => $newData->name,
                'description' => $newData->description,
                'price' => 'price',
                'old_price' => 'old_price',
                'cost' => 'cost',
                'sku' => 'sku',
                'barcode' => 'barcode',
                'quantity' => 'quantity',
                'is_visible' => 'is_visible',
                'published_at' => 'updated_at',
                'category_id' => $newData->category_id,
                'brand_id' => $newData->brand_id,
            ])
            ->call('create')
            ->assertHasFormErrors(['name' => 'required'])
        ;
    }

    public function test_validate_input_product_null_slug()
    {
        $newData = Product::factory()->make();

        Livewire::test(ProductResource\Pages\CreateProduct::class)
            ->fillForm([
                'name' => $newData->name,
                'slug' => null,
                'description' => $newData->description,
                'price' => 'price',
                'old_price' => 'old_price',
                'cost' => 'cost',
                'sku' => 'sku',
                'barcode' => 'barcode',
                'quantity' => 'quantity',
                'is_visible' => 'is_visible',
                'published_at' => 'updated_at',
                'category_id' => $newData->category_id,
                'brand_id' => $newData->brand_id,
            ])
            ->call('create')
            ->assertHasFormErrors(['slug' => 'required'])
        ;
    }

    public function test_validate_input_product_null_price()
    {
        $newData = Product::factory()->make();

        Livewire::test(ProductResource\Pages\CreateProduct::class)
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->name,
                'description' => $newData->description,
                'price' => null,
                'old_price' => 'old_price',
                'cost' => 'cost',
                'sku' => 'sku',
                'barcode' => 'barcode',
                'quantity' => 'quantity',
                'is_visible' => 'is_visible',
                'published_at' => 'updated_at',
                'category_id' => $newData->category_id,
                'brand_id' => $newData->brand_id,
            ])
            ->call('create')
            ->assertHasFormErrors(['price' => 'required'])
        ;
    }

    public function test_validate_input_product_null_old_price()
    {
        $newData = Product::factory()->make();

        Livewire::test(ProductResource\Pages\CreateProduct::class)
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->name,
                'description' => $newData->description,
                'price' => 'price',
                'old_price' => null,
                'cost' => 'cost',
                'sku' => 'sku',
                'barcode' => 'barcode',
                'quantity' => 'quantity',
                'is_visible' => 'is_visible',
                'published_at' => 'updated_at',
                'category_id' => $newData->category_id,
                'brand_id' => $newData->brand_id,
            ])
            ->call('create')
            ->assertHasFormErrors(['old_price' => 'required'])
        ;
    }

    public function test_validate_input_product_null_cost()
    {
        $newData = Product::factory()->make();

        Livewire::test(ProductResource\Pages\CreateProduct::class)
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->name,
                'description' => $newData->description,
                'price' => 'price',
                'old_price' => 'old_price',
                'cost' => null,
                'sku' => 'sku',
                'barcode' => 'barcode',
                'quantity' => 'quantity',
                'is_visible' => 'is_visible',
                'published_at' => 'updated_at',
                'category_id' => $newData->category_id,
                'brand_id' => $newData->brand_id,
            ])
            ->call('create')
            ->assertHasFormErrors(['cost' => 'required'])
        ;
    }

    public function test_validate_input_product_null_sku()
    {
        $newData = Product::factory()->make();

        Livewire::test(ProductResource\Pages\CreateProduct::class)
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->name,
                'description' => $newData->description,
                'price' => 'price',
                'old_price' => 'old_price',
                'cost' => 'cost',
                'sku' => null,
                'barcode' => 'barcode',
                'quantity' => 'quantity',
                'is_visible' => 'is_visible',
                'published_at' => 'updated_at',
                'category_id' => $newData->category_id,
                'brand_id' => $newData->brand_id,
            ])
            ->call('create')
            ->assertHasFormErrors(['sku' => 'required'])
        ;
    }

    public function test_validate_input_product_null_barcode()
    {
        $newData = Product::factory()->make();

        Livewire::test(ProductResource\Pages\CreateProduct::class)
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->name,
                'description' => $newData->description,
                'price' => 'price',
                'old_price' => 'old_price',
                'cost' => 'cost',
                'sku' => 'sku',
                'barcode' => null,
                'quantity' => 'quantity',
                'is_visible' => 'is_visible',
                'published_at' => 'updated_at',
                'category_id' => $newData->category_id,
                'brand_id' => $newData->brand_id,
            ])
            ->call('create')
            ->assertHasFormErrors(['barcode' => 'required'])
        ;
    }

    public function test_validate_input_product_null_quantity()
    {
        $newData = Product::factory()->make();

        Livewire::test(ProductResource\Pages\CreateProduct::class)
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->name,
                'description' => $newData->description,
                'price' => 'price',
                'old_price' => 'old_price',
                'cost' => 'cost',
                'sku' => 'sku',
                'barcode' => 'barcode',
                'quantity' => null,
                'is_visible' => 'is_visible',
                'published_at' => 'updated_at',
                'category_id' => $newData->category_id,
                'brand_id' => $newData->brand_id,
            ])
            ->call('create')
            ->assertHasFormErrors(['quantity' => 'required'])
        ;
    }

    public function test_validate_input_product_null_published()
    {
        $newData = Product::factory()->make();

        Livewire::test(ProductResource\Pages\CreateProduct::class)
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->name,
                'description' => $newData->description,
                'price' => 'price',
                'old_price' => 'old_price',
                'cost' => 'cost',
                'sku' => 'sku',
                'barcode' => 'barcode',
                'quantity' => 'quantity',
                'is_visible' => 'is_visible',
                'published_at' => null,
                'category_id' => $newData->category_id,
                'brand_id' => $newData->brand_id,
            ])
            ->call('create')
            ->assertHasFormErrors(['published_at' => 'required'])
        ;
    }

    public function test_validate_input_product_null_category()
    {
        $newData = Product::factory()->make();

        Livewire::test(ProductResource\Pages\CreateProduct::class)
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->name,
                'description' => $newData->description,
                'price' => 'price',
                'old_price' => 'old_price',
                'cost' => 'cost',
                'sku' => 'sku',
                'barcode' => 'barcode',
                'quantity' => 'quantity',
                'is_visible' => 'is_visible',
                'published_at' => 'update_at',
                'category_id' => null,
                'brand_id' => $newData->brand_id,
            ])
            ->call('create')
            ->assertHasFormErrors(['category_id' => 'required'])
        ;
    }
}
