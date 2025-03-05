<?php

namespace App\DTO;

class OrderStoreDTO
{

    public function __construct(
        public int $customer_id,
        public string $status,
        public float $total,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            customer_id: $validated['customer_id'],
            status: $validated['status'],
            total: $validated['total'],
        );
    }

    public function toArray(): array
    {
        return [
            'customer_id' => $this->customer_id,
            'status' => $this->status,
            'total' => $this->total,
        ];
    }

}
