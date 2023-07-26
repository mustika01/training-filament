<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Customer;
use App\Filament\Resources\CustomerResource;
use App\Filament\Resources\CustomerResource\Pages\ListCustomers;

/**
 * @internal
 */
class ListCustomerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // render
    public function test_render_page_customer()
    {
        $this->get(CustomerResource::getUrl('index'))
            ->assertSuccessful()
        ;
    }

    public function test_list_customer()
    {
        $customer = Customer::factory()->count(5)->create();

        Livewire::test(ListCustomers::class)
            ->assertCanSeeTableRecords($customer)
        ;
    }

    public function test_list_customer_name()
    {
        Customer::factory()->count(5)->create();

        Livewire::test(ListCustomers::class)
            ->assertCanRenderTableColumn('name_c')
            ->assertCanRenderTableColumn('email_c')
            ->assertCanRenderTableColumn('country_c')
            ->assertCanRenderTableColumn('phone_c')
        ;
    }

    public function test_search_customer_by_name()
    {
        $customer = Customer::factory()->count(5)->create();

        // dd($customer);

        $name = $customer->first()->name_c;

        Livewire::test(ListCustomers::class)
            ->searchTable($name)
            ->assertCanSeeTableRecords($customer->where('name_c', $name))
            ->assertCanNotSeeTableRecords($customer->where('name_c', '!=', $name))
        ;
    }
}
