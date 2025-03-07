<?php

namespace App\DTO;

class UserUpdateDTO
{
    public string $name;

    public string $email;

    public ?string $password;

    public string $role;

    public int $userId;

    public function __construct(string $name, string $email, ?string $password, string $role, int $userId)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->userId = $userId;
    }

    public static function fromRequest(array $data, int $userId): self
    {
        return new self(
            $data['name'],
            $data['email'],
            $data['password'] ?? null,
            $data['role'],
            $userId
        );
    }
}
