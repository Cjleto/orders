<?php

namespace App\Services;

use App\Models\Customer;
use App\DTO\CustomerStoreDTO;
use App\DTO\CustomerUpdateDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\CustomerRepositoryContract;
use Illuminate\Contracts\Pagination\Paginator;

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

        $customer = $this->customerRepository->create($userStoreDTO->toArray());

        return $customer;

    }


    public function update(CustomerUpdateDTO $customerUpdateDTO): Customer
    {

        $customer = $this->customerRepository->find($customerUpdateDTO->id);

        $customer->update($customerUpdateDTO->toArray());

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

    public function getWithRelations(?int $perPage = null): Collection|Paginator
    {
        return $this->customerRepository->getWithRelations(['orders', 'orders.products', 'orders.products.photo'], $perPage);

    }

    public function getWithSortingAndIncludes(?int $perPage = null): Collection|Paginator
    {
        return $this->customerRepository->getWithSortingAndIncludes();
    }

}
