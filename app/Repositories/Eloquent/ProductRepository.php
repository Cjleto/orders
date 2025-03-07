<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryContract;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository implements ProductRepositoryContract
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function query(): Builder
    {
        return $this->model->query();
    }

    public function searchByFieldPaginated(string $search, string $field, int $paginationCount = 10): LengthAwarePaginator
    {
        $query = $this->model;

        if ($search) {
            $query = $query->where($field, 'LIKE', "%$search%");
        }

        return $query->paginate($paginationCount);
    }
}
