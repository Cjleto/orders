<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\OrderRepositoryContract;

class OrderRepository extends BaseRepository implements OrderRepositoryContract
{

    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

}
