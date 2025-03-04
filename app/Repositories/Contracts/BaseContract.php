<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseContract
{
    /**
     * Find resource.
     *
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model;

    /**
     * Find all resources.
     *
     * @return Collection
     */
    public function findAll(): Collection;

    /**
     * Create new resource.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Update existing resource.
     *
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data): Model;

    /**
     * Delete existing resource.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool|null;

    /**
     * Paginate all resources.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator;


    /**
     * Search resources by field.
     *
     * @param string $field
     * @param string $value
     * @return Collection
     */
    public function searchByField(string $field, string $value): Collection;

    /**
     * Search resources by field with pagination.
     *
     * @param string $field
     * @param string $value
     * @param int $paginationCount
     * @return LengthAwarePaginator
     */
    public function searchByFieldPaginated(string $field, string $value, int $paginationCount = 10): LengthAwarePaginator;
}
