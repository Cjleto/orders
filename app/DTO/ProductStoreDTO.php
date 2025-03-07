<?php

namespace App\DTO;

use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

final readonly class ProductStoreDTO
{
    public function __construct(
        public string $name,
        public string $description,
        public float $price,
        /** @var TemporaryUploadedFile|UploadedFile|null */
        public mixed $newPhoto = null,
        public int $stock = 0
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            $data['name'],
            $data['description'],
            $data['price'],
            $data['newPhoto'] ?? null,
            $data['stock'] ?? 0
        );
    }
}
