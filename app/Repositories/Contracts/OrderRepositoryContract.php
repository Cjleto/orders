<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface OrderRepositoryContract
{
    public function getOrdersBetweenDates(string $start, string $end): Collection;
}
