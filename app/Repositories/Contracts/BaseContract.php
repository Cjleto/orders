<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseContract
{
    /**
     * Find resource.
     */
    public function find(int $id): ?Model;

    /**
     * Find all resources.
     */
    public function findAll(): Collection;

    /**
     * Create new resource.
     */
    public function create(array $data): Model;

    /**
     * Update existing resource.
     */
    public function update(int $id, array $data): Model;

    /**
     * Delete existing resource.
     *
     * @param  int  $id
     */
    public function delete(string $id): ?bool;

    /**
     * Paginate all resources.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    /**
     * Search resources by field.
     */
    public function searchByField(string $field, string $value): Collection;

    /**
     * Search resources by field with pagination.
     */
    public function searchByFieldPaginated(string $field, string $value, int $paginationCount = 10): LengthAwarePaginator;
}
