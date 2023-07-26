<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Brand;
use Livewire\Livewire;
use Filament\Pages\Actions\DeleteAction;
use App\Filament\Resources\BrandResource\Pages\EditBrand;

/**
 * @internal
 */
class DeleteBrandTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_delete_brand()
    {
        $brand = Brand::factory()->create();

        Livewire::test(EditBrand::class, [
            'record' => $brand->getKey(),
        ])
            ->callPageAction(DeleteAction::class)
        ;

        $this->assertModelMissing($brand);
    }
}
