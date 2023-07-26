<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Product;
use Filament\Pages\Actions\DeleteAction;
use App\Filament\Resources\ProductResource\Pages\EditProduct;

/**
 * @internal
 */
class DeleteProductTest extends TestCase
{
    public function test_delete_product()
    {
        $product = Product::factory()->create();

        Livewire::test(EditProduct::class, [
            'record' => $product->getKey(),
        ])
            ->callPageAction(DeleteAction::class)
        ;

        $this->assertModelMissing($product);
    }
}
