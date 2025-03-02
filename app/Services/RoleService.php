<?php

namespace App\Services;

use Spatie\Permission\Contracts\Role;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Eloquent\RoleRepository;

use App\Repositories\Contracts\RoleRepositoryContract;

/**
 * @property RoleRepository roleRepository
 */
class RoleService
{

    public function __construct(protected RoleRepositoryContract $roleRepository) {}

    public function all(): Collection
    {
        return $this->roleRepository->findAll();
    }

}
