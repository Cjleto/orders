<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function syncRoles(int $id, array $roles)
    {
        $user = $this->model->find($id);
        $user->roles()->sync($roles);
    }
}
