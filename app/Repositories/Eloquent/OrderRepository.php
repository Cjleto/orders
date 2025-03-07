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

    public function getOrderIndexData(array $searchData, array $relations = [])
    {
        $query = Order::query();

        $query->when($searchData['id'], function ($query) use ($searchData) {
            return $query->where('id', $searchData['id']);
        });

        $query->when($searchData['status'], function ($query) use ($searchData) {
            return $query->where('status', $searchData['status']);
        });

        $query->when(count($relations), function ($query) use ($relations) {
            return $query->with($relations);
        });

        return $query->paginate(10);
    }


}
