<?php

namespace App\Services;

use App\Repositories\Contracts\RoleRepositoryContract;
use App\Repositories\Eloquent\RoleRepository;
use Illuminate\Database\Eloquent\Collection;

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
