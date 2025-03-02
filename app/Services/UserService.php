<?php

namespace App\Services;

use App\DTO\UserStoreDTO;
use App\DTO\UserUpdateDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\RoleRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;

/**
 * @property UserRepository userRepository
 */
class UserService
{
    public function __construct(
        protected UserRepositoryContract $userRepository,
        protected RoleRepositoryContract $roleRepository
    ){}

    public function all(): Collection
    {
        return $this->userRepository->findAll();
    }

    public function store (UserStoreDTO $userStoreDTO): User
    {

        $user = $this->userRepository->create([
            'name' => $userStoreDTO->name,
            'email' => $userStoreDTO->email,
            'password' => bcrypt($userStoreDTO->password)
        ]);

        $user->assignRole($userStoreDTO->role);

        return $user;
    }


    public function update(UserUpdateDTO $userUpdateDTO): User
    {

        $user = $this->userRepository->find($userUpdateDTO->userId);

        $data = [
            'name' => $userUpdateDTO->name,
            'email' => $userUpdateDTO->email,
        ];

        if ($userUpdateDTO->password) {
            $data['password'] = $userUpdateDTO->password;
        }

        $user->update($data);

        $user->syncRoles([$userUpdateDTO->role]);

        return $user;

    }

    public function syncRoles(int $id, array $roles): bool
    {
        return $this->userRepository->syncRoles($id, $roles);
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->userRepository->paginate($perPage);
    }

    public function delete(int $id): bool|null
    {
        return $this->userRepository->delete($id);
    }

}
