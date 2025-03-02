<?php

namespace App\DTO;

class CustomerUpdateDTO
{

    public function __construct(
        public int $id,
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $address,
        public string $phone,
    ) {}

    public static function fromRequest(array $validated, int $customerId): self
    {
        return new self(
            id: $customerId,
            first_name: $validated['first_name'],
            last_name: $validated['last_name'],
            email: $validated['email'],
            address: $validated['address'],
            phone: $validated['phone']
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
        ];
    }



}
