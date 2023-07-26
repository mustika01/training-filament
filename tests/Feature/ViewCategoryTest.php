<?php

namespace Tests\Feature;

use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\CategoryResource\Pages\ViewCategory;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ViewCategoryTest extends TestCase
{
    public function test_render_page_category_view()
   {
       $this->get(CategoryResource::getUrl('view', [
        'record' => Category::factory()->create(),
       ]))->assertSuccessful();
   }

    public function test_retrieve_data()
    {
        $categories = Category::factory()->create();

        Livewire::test(ViewCategory::class, [
            'record' => $categories->getKey(),
        ])
            ->assertFormSet([
                'name' => $categories->name,
                'slug' => $categories->slug,
                'visibility' => $categories->visibility,
                'description' => $categories->description,
            ])
        ;
    }
}
