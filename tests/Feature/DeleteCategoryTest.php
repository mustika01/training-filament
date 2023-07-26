<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Category;
use Filament\Pages\Actions\DeleteAction;
use App\Filament\Resources\CategoryResource\Pages\EditCategory;

/**
 * @internal
 */
class DeleteCategoryTest extends TestCase
{
    public function test_delete_category()
    {
        $categories = Category::factory()->create();

        Livewire::test(EditCategory::class, [
            'record' => $categories->getKey(),
        ])
            ->callPageAction(DeleteAction::class)
        ;

        $this->assertModelMissing($categories);
    }
}
