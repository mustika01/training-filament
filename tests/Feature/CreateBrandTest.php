<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Brand;
use Livewire\Livewire;
use App\Filament\Resources\BrandResource\Pages\CreateBrand;

/**
 * @internal
 */
class CreateBrandTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_render_create_brand()
    {
        Livewire::test(CreateBrand::class)
            ->assertSuccessful()
        ;
    }

    //create new brand
    public function test_create_brand()
    {
        $newData = Brand::factory()->make();

        Livewire::test(CreateBrand::class)
            ->fillForm([

                'name_b' => $newData->name_b,
                'slug_b' => $newData->slug_b,
                'web_b' => $newData->web_b,
                'visible_b' => $newData->visible_b,
                'description_b' => $newData->description_b,
            ])
            ->call('create')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(Brand::class, [
            'name_b' => $newData->name_b,
            'slug_b' => $newData->slug_b,
            'web_b' => $newData->web_b,
            'visible_b' => $newData->visible_b,
            'description_b' => $newData->description_b,
        ]);
    }

    //validate required brand
    public function test_validate_input_name_b_brand()
    {
        $newData = Brand::factory()->make();

        Livewire::test(CreateBrand::class)
            ->fillForm([
                'name_b' => null,
                'slug_b' => $newData->slug_b,
                'web_b' => $newData->web_b,
                'visible_b' => $newData->visible_b,
                'description_b' => $newData->description_b,
            ])
            ->call('create')
            ->assertHasFormErrors(['name_b' => 'required'])
        ;
    }

    public function test_validate_input_slug_b_brand()
    {
        $newData = Brand::factory()->make();

        Livewire::test(CreateBrand::class)
            ->fillForm([
                'name_b' => $newData->slug_b,
                'slug_b' => null,
                'web_b' => $newData->web_b,
                'visible_b' => $newData->visible_b,
                'description_b' => $newData->description_b,
            ])
            ->call('create')
            ->assertHasFormErrors(['slug_b' => 'required'])
        ;
    }

    public function test_validate_input_web_b_brand()
    {
        $newData = Brand::factory()->make();

        Livewire::test(CreateBrand::class)
            ->fillForm([
                'name_b' => $newData->name_b,
                'slug_b' => $newData->slug_b,
                'web_b' => null,
                'visible_b' => $newData->visible_b,
                'description_b' => $newData->description_b,
            ])
            ->call('create')
            ->assertHasFormErrors(['web_b' => 'required'])
        ;
    }
}
