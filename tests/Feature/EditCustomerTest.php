<?php

namespace Tests\Feature;

use App\Filament\Resources\CustomerResource\Pages\EditCustomer;
use App\Filament\Resources\CustomerResource\Pages\ListCustomers;
use App\Models\Customer;
use Filament\Pages\Actions\DeleteAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditCustomerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

     // render edit
     public function test_render_customer_page()
     {
         $customer = Customer::factory()->create();
 
         Livewire::test(EditCustomer::class, [
             'record' => $customer->getKey(),
 
         ])
             ->assertSuccessful()
         ;
     }

      // validate edit
    public function tets_validate_customer()
    {
        $customer = Customer::factory()->create();

        Livewire::test(ListCustomers::class)
            ->callTableAction(EditAction::class, $customer, data: [
                'name_c' => null,
            ])
            ->assertHasTableActionErrors(['name_c' => ['required']])
        ;
    }

    public function test_update_customer()
    {
        $customer = Customer::factory()->create();
        $newData = Customer::factory()->make();

        Livewire::test(EditCustomer::class, [
            'record' => $customer->getKey(),
        ])
            ->assertFormSet([
                'name_c' => $customer->name_c,
                'email_c' => $customer->email_c,
                'phone_c' => $customer->phone_c,
                'born_c' => $customer->born_c,
            ])
            ->fillForm([
                'name_c' => $newData->name_c,
                'email_c' => $newData->email_c,
                'phone_c' => $newData->phone_c,
                'born_c' => $newData->born_c,
            ])
            ->call('save')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(Customer::class, [
            'id' => $customer->getKey(),
            'name_c' => $newData->name_c,
            'email_c' => $newData->email_c,
            'phone_c' => $newData->phone_c,
            'born_c' => $newData->born_c,
        ]);
    }
}
