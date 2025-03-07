<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\DTO\CustomerStoreDTO;
use App\DTO\CustomerUpdateDTO;
use App\Services\CustomerService;
use App\Http\Requests\StoreCustomer;
use App\Http\Requests\UpdateCustomer;
use App\Http\Controllers\ApiController;
use App\Http\Resources\CustomerResource;

class CustomerController extends ApiController
{

    public function __construct(
        protected CustomerService $customerService
    ) {}

    public function index()
    {
        $customers = $this->customerService->getWithSortingAndIncludes();
        return CustomerResource::collection($customers);

    }

    public function store(StoreCustomer $request)
    {
        $validated = $request->validated();
        $dto = CustomerStoreDTO::fromRequest($validated);
        $customer = $this->customerService->store($dto);
        return $this->success(new CustomerResource($customer));
    }

    public function show(Request $request, Customer $customer)
    {

        $customer = $this->loadIncludes($request, $customer);

        return $this->success(new CustomerResource($customer));
    }

    public function update(UpdateCustomer $request, Customer $customer)
    {
        $validated = $request->validated();
        $customerUpdateDTO = CustomerUpdateDTO::fromRequest($validated, $customer->id);
        $customer = $this->customerService->update($customerUpdateDTO);

        return $this->success(new CustomerResource($customer));
    }

    public function destroy(string $id)
    {
        $this->customerService->delete($id);
        return $this->success();
    }
}
