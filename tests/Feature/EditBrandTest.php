<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Brand;
use Livewire\Livewire;
use App\Filament\Resources\BrandResource\Pages\EditBrand;
use App\Filament\Resources\BrandResource\Pages\ListBrands;

/**
 * @internal
 */
class EditBrandTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

     // render edit
     public function test_render_brand_page()
     {
         $brand = Brand::factory()->create();

         Livewire::test(EditBrand::class, [
             'record' => $brand->getKey(),

         ])
             ->assertSuccessful()
         ;
     }

     // validate edit
     public function tets_validate_brand()
     {
         $brand = Brand::factory()->create();

         Livewire::test(ListBrands::class)
             ->callTableAction(EditAction::class, $brand, data: [
                 'name_b' => null,
             ])
             ->assertHasTableActionErrors(['name_b' => ['required']])
         ;
     }

     public function test_update_brand()
    {
        $brand = Brand::factory()->create();
        $newData = Brand::factory()->make();

        Livewire::test(EditBrand::class, [
            'record' => $brand->getKey(),
        ])
            ->assertFormSet([
                'name_b' => $brand->name_b,
                'slug_b' => $brand->slug_b,
                'visible_b' => $brand->visible_b,
                'web_b' => $brand->web_b,
                'description_b' => $brand->description_b,
            ])
            ->fillForm([
                'name_b' => $newData->name_b,
                'slug_b' => $newData->slug_b,
                'visible_b' => $newData->visible_b,
                'web_b' => $newData->web_b,
                'description_b' => $newData->description_b,
            ])
            ->call('save')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(Brand::class, [
            'id' => $brand->getKey(),
            'name_b' => $newData->name_b,
            'slug_b' => $newData->slug_b,
            'visible_b' => $newData->visible_b,
            'web_b' => $newData->web_b,
            'description_b' => $newData->description_b,
        ]);
    }
}
