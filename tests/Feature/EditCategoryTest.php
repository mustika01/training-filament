<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Category;
use Filament\Pages\Actions\EditAction;
use App\Filament\Resources\CategoryResource\Pages\EditCategory;

/**
 * @internal
 */
class EditCategoryTest extends TestCase
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
    public function test_render_category_page()
    {
        $categories = Category::factory()->create();

        Livewire::test(EditCategory::class, [
            'record' => $categories->getKey(),

        ])
            ->assertSuccessful()
        ;
    }

    // validate edit
    public function tets_validate_category()
    {
        $categories = Category::factory()->create();

        Livewire::test(ListCategory::class)
            ->callTableAction(EditAction::class, $categories, data: [
                'name' => null,
            ])
            ->assertHasTableActionErrors(['name' => ['required']])
        ;
    }

    public function test_update_category()
    {
        $categories = Category::factory()->create();
        $newData = Category::factory()->make();

        Livewire::test(EditCategory::class, [
            'record' => $categories->getKey(),
        ])
            ->assertFormSet([
                'name' => $categories->name,
                'slug' => $categories->slug,
                'visibility' => $categories->visibility,
                'description' => $categories->description,
            ])
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->slug,
                'visibility' => $newData->visibility,
                'description' => $newData->description,
            ])
            ->call('save')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(Category::class, [
            'id' => $categories->getKey(),
            'name' => $newData->name,
            'visibility' => $newData->visibility,
            'description' => $newData->description,
        ]);
    }
}
