<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoleRepositoryContract;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryContract
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
