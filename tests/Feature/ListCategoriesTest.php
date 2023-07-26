<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Category;
use App\Filament\Resources\CategoryResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Filament\Resources\CategoryResource\Pages\ListCategories;

/**
 * @internal
 */
class ListCategoriesTest extends TestCase
{
    use RefreshDatabase;

    //render
    public function test_render_page_category()
    {
        $this->get(CategoryResource::getUrl('index'))
            ->assertSuccessful()
        ;
    }

    public function test_list_categories()
    {
        $categories = Category::factory()->count(5)->create();

        $category = Category::factory()->parent()->create();

        Livewire::test(ListCategories::class)
            ->assertCanSeeTableRecords($categories)
        ;
    }

    public function test_list_categories_name()
    {
        Category::factory()->count(5)->create();

        Livewire::test(ListCategories::class)
            ->assertCanRenderTableColumn('name')
            ->assertCanRenderTableColumn('parent.name')
            ->assertCanRenderTableColumn('updated_at')
        ;
    }

    public function test_search_category_by_name()
    {
        $categories = Category::factory()->count(5)->create();

        $name = $categories->first()->name;

        Livewire::test(ListCategories::class)
            ->searchTable($name)
            ->assertCanSeeTableRecords($categories->where('name', $name))
            ->assertCanNotSeeTableRecords($categories->where('name', '!=', $name))
        ;
    }

    public function test_filter_category_by_visibility()
    {
        $categories = Category::factory()->count(5)->create();

        Livewire::test(ListCategories::class)
            ->assertCanSeeTableRecords($categories)
            ->filterTable('visibility')
            ->assertCanSeeTableRecords($categories->where('visibility', true))
            ->assertCanNotSeeTableRecords($categories->where('visibility', false))
        ;
    }

    
}
