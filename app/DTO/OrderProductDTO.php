<?php

namespace App\DTO;

class OrderProductDTO
{

    public function __construct(
        public int $product_id,
        public int $quantity,
        public string $product_name,
        public float $product_price,
    ) {}

    public function toArray(): array
    {
        return [
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'product_name' => $this->product_name,
            'product_price' => $this->product_price,
        ];
    }

}
