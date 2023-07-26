<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Brand;
use Livewire\Livewire;
use App\Filament\Resources\BrandResource\Pages\ListBrands;

/**
 * @internal
 */
class ListBrandTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_list_brand()
    {
        $brand = Brand::factory()->count(5)->create();

        Livewire::test(ListBrands::class)
            ->assertCanSeeTableRecords($brand)
        ;
    }

    public function test_list_brand_name()
    {
        Brand::factory()->count(5)->create();

        // cannot use slug_b
        Livewire::test(ListBrands::class)
            ->assertCanRenderTableColumn('name_b')
            ->assertCanRenderTableColumn('web_b')
            ->assertCanRenderTableColumn('visible_b')
            ->assertCanRenderTableColumn('updated_at')
        ;
    }

    public function test_search_brand_by_name_b()
    {
        $brand = Brand::factory()->count(5)->create();

        $name = $brand->first()->name_b;

        Livewire::test(ListBrands::class)
            ->searchTable($name)
            ->assertCanSeeTableRecords($brand->where('name_b', $name))
            ->assertCanNotSeeTableRecords($brand->where('name_b', '!=', $name))
        ;
    }
}
