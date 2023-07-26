<?php

namespace Tests\Feature;

use App\Filament\Resources\CustomerResource\Pages\EditCustomer;
use App\Models\Customer;
use Filament\Pages\Actions\DeleteAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteCustomerTest extends TestCase
{
    public function test_delete_customer()
    {
        $customer = Customer::factory()->create();

        Livewire::test(EditCustomer::class,[
            'record' => $customer->getKey(),
        ])
        ->callPageAction(DeleteAction::class);

        $this->assertSoftDeleted($customer);
    }
}
