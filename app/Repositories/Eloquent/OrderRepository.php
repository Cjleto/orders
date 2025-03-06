<?php

namespace App\Repositories\Eloquent;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Collection;
use App\Repositories\Contracts\OrderRepositoryContract;

class OrderRepository extends BaseRepository implements OrderRepositoryContract
{

    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function getOrdersBetweenDates(string $start, string $end): Collection
    {
        return $this->model->whereBetween('created_at', [
            Carbon::parse($start)->startOfDay(),
            Carbon::parse($end)->endOfDay()
        ])->get();
    }


}
