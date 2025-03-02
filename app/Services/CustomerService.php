<?php

namespace App\Services;

use App\Models\Customer;
use App\DTO\CustomerStoreDTO;
use App\DTO\CustomerUpdateDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\CustomerRepositoryContract;

/**
 * @property CustomerRepository customerRepository
 */
class CustomerService
{
    public function __construct(
        protected CustomerRepositoryContract $customerRepository,
    ){}

    public function all(): Collection
    {
        return $this->customerRepository->findAll();
    }

    public function store (CustomerStoreDTO $userStoreDTO): Customer
    {

        $customer = $this->customerRepository->create([
            'first_name' => $userStoreDTO->first_name,
            'last_name' => $userStoreDTO->last_name,
            'email' => $userStoreDTO->email,
            'address' => $userStoreDTO->address,
            'phone' => $userStoreDTO->phone,
        ]);

        return $customer;

    }


    public function update(CustomerUpdateDTO $customerUpdateDTO): Customer
    {

        $customer = $this->customerRepository->find($customerUpdateDTO->id);

        $data = [
            'first_name' => $customerUpdateDTO->first_name,
            'last_name' => $customerUpdateDTO->last_name,
            'email' => $customerUpdateDTO->email,
            'address' => $customerUpdateDTO->address,
            'phone' => $customerUpdateDTO->phone,
        ];

        $customer->update($data);

        return $customer;

    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->customerRepository->paginate($perPage);
    }

    public function delete(int $id): bool|null
    {
        return $this->customerRepository->delete($id);
    }

}
