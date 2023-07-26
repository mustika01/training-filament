<?php

namespace Tests\Feature;

use App\Filament\Resources\CustomerResource\Pages\CreateCustomer;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateCustomerTest extends TestCase
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

    //render 
    public function test_render_create_customer()
    {
        Livewire::test(CreateCustomer::class)
            ->assertSuccessful()
        ;
    }

    //make new cutomer
    public function test_create_customer()
    {
        $newData = Customer::factory()->make();

        Livewire::test(CreateCustomer::class)
            ->fillForm([

                'name_c' => $newData->name_c,
                'email_c' => $newData->email_c,
                'phone_c' => $newData->phone_c,
                'born_c' => $newData->born_c,
            ])
            ->call('create')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(Customer::class, [
            'name_c' => $newData->name_c,
                'email_c' => $newData->email_c,
                'phone_c' => $newData->phone_c,
                'born_c' => $newData->born_c,
        ]);
    }

    //validate required
    public function test_validate_input_name_b_customer()
    {
        $newData = Customer::factory()->make();

        Livewire::test(CreateCustomer::class)
        ->fillForm([
            'name_c' => null,
            'email_c' => $newData->name_c,
            'phone_c' => $newData->phone_c,
            'born_c' => $newData->born_c,
        ])
        ->call('create')
        ->assertHasFormErrors(['name_c' => 'required']);
    }

    public function test_validate_input_email_customer()
    {
        $newData = Customer::factory()->make();

        Livewire::test(CreateCustomer::class)
        ->fillForm([
            'name_c' => $newData->name_c,
            'email_c' => null,
            'phone_c' => $newData->phone_c,
            'born_c' => $newData->born_c,
        ])
        ->call('create')
        ->assertHasFormErrors(['email_c' => 'required']);
    }
}
