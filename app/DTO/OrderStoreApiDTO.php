<?php

namespace App\DTO;

class OrderStoreApiDTO
{
    public function __construct(
        public int $customer_id,
        public array $products,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            customer_id: $validated['customer_id'],
            products: $validated['products'],
        );
    }

    public function toArray(): array
    {
        return [
            'customer_id' => $this->customer_id,
            'products' => $this->products,
        ];
    }
}
