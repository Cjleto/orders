<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
interface ProductRepositoryContract
{
    public function searchByField (string $search, string $field, int $paginationCount = 10): LengthAwarePaginator;

}
