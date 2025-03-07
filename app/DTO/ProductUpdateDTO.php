<?php

namespace App\DTO;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

final readonly class ProductUpdateDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public string $description,
        public float $price,
        /** @var TemporaryUploadedFile|UploadedFile|null */
        public mixed $newPhoto = null,
        public int $stock = 0
    ) {}

    public static function fromRequest(array $data, int $productId): self
    {
        return new self(
            id: $productId,
            name: $data['name'],
            description: $data['description'],
            price: $data['price'],
            newPhoto: $data['newPhoto'] ?? null,
            stock: $data['stock'] ?? 0
        );
    }
}
