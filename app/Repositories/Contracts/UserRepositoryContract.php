<?php

namespace App\Repositories\Contracts;

interface UserRepositoryContract
{
    public function syncRoles(int $id, array $roles);
}
