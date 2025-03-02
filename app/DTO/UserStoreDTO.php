<?php

namespace App\DTO;

class UserStoreDTO
{

    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $role,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
        ];
    }

}
