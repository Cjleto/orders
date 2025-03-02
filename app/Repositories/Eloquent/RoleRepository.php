<?php

namespace App\Repositories\Eloquent;


use Spatie\Permission\Models\Role;
use App\Repositories\Contracts\RoleRepositoryContract;

class RoleRepository extends BaseRepository implements RoleRepositoryContract
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
