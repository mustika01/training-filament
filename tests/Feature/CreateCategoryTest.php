<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Category;
use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\CategoryResource\Pages\CreateCategory;


/**
 * @internal
 */
class CreateCategoryTest extends TestCase
{
    //render
    public function test_render_create_category()
    {
        Livewire::test(CreateCategory::class)
            ->assertSuccessful()
        ;
    }

    public function test_create_category()
    {
        $newData = Category::factory()->make();

        Livewire::test(CategoryResource\Pages\CreateCategory::class)
            ->fillForm([

                'name' => $newData->name,
                'slug' => $newData->slug,
                'description' => $newData->description,
            ])
            ->call('create')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(Category::class, [
            'name' => $newData->name,
            'slug' => $newData->slug,
            'description' => $newData->description,
        ]);
    }

    public function test_validate_input_name_category()
    {
        $newData = Category::factory()->make();

        Livewire::test(CreateCategory::class)
        ->fillForm([
            'name' => null,
            'slug' => $newData->slug,
            'description' => $newData->description,
        ])
        ->call('create')
        ->assertHasFormErrors(['name' => 'required']);
    }

    public function test_validate_input_slug_category()
    {
        $newData = Category::factory()->make();

        Livewire::test(CreateCategory::class)
        ->fillForm([
            'name' => $newData->name,
            'slug' => null,
            'description' => $newData->description,
        ])
        ->call('create')
        ->assertHasFormErrors(['slug' => 'required']);
    }

}
