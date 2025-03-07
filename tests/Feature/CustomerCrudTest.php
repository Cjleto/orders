<?php

use App\DTO\CustomerUpdateDTO;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\CustomerService;
use Database\Seeders\PermissionsRolesSeeder;
use Illuminate\Http\Response;

beforeEach(function () {

    $this->seed(PermissionsRolesSeeder::class);

    $this->customerService = mock(CustomerService::class);
    $this->app->instance(CustomerService::class, $this->customerService);
    $this->user = \App\Models\User::factory()->admin()->create();

    $this->actingAs($this->user);
});

it('can list all customers', function () {
    $customers = Customer::factory()->count(3)->create();

    $this->customerService
        ->shouldReceive('getWithSortingAndIncludes')
        ->withAnyArgs()
        ->once()
        ->andReturn($customers);

    $response = $this->getJson(route('api.customers.index'));

    $response->assertStatus(Response::HTTP_OK)
        ->assertJson(CustomerResource::collection($customers)->response()->getData(true));

});

it('can store a customer', function () {
    // Crea i dati del cliente
    $customerData = Customer::factory()->make()->toArray();

    // Crea un'istanza del modello Customer con i dati
    $customer = new Customer($customerData);

    // Mock del servizio: restituire l'istanza del modello Customer
    $this->customerService
        ->shouldReceive('store')
        ->once()
        ->andReturn($customer);

    // Esegui la richiesta POST per creare un cliente
    $response = $this->postJson(route('api.customers.store'), $customerData);

    // Controlla che la risposta sia OK e che i dati siano corretti
    $response->assertOk()
        ->assertJson([
            'data' => $customerData,  // Verifica solo la parte 'data'
        ]);
});

it('can show a customer', function () {
    $customer = Customer::factory()->create();

    $response = $this->getJson(route('api.customers.show', $customer->id));

    // Verifica che la risposta sia corretta
    $response->assertOk()
        ->assertJsonFragment(['data' => CustomerResource::make($customer)->response()->getData(true)['data']]);
});

it('can update a customer', function () {
    $customer = Customer::factory()->create();
    $updatedData = ['new_name' => 'Updated Name'];
    $dto = new CustomerUpdateDTO(
        id: $customer->id,
        first_name: $updatedData['new_name'],
        last_name: $customer->last_name,
        email: $customer->email,
        address: $customer->address,
        phone: $customer->phone
    );

    $this->customerService
        ->shouldReceive('update')
        ->once()
        ->andReturnUsing(function ($dto) use ($customer) {
            // Aggiorna il customer con i dati del DTO e salva nel database
            $customer->fill($dto->toArray());
            $customer->save(); // Salva nel database

            return $customer; // Restituisce l'oggetto aggiornato
        });

    $response = $this->putJson(route('api.customers.update', $customer->id), $dto->toArray());

    $response->assertOk();

    $this->assertDatabaseHas('customers', ['id' => $customer->id, 'first_name' => $updatedData['new_name']]);
});

it('can delete a customer', function () {
    $customer = Customer::factory()->create();

    $this->customerService
        ->shouldReceive('delete')
        ->once()
        ->andReturnUsing(fn ($id) => Customer::destroy($id));

    $response = $this->deleteJson(route('api.customers.destroy', $customer->id));

    $response->assertOk();

    $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
});
