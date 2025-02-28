<?php

namespace App\Http\Dtos;

use App\Enums\IsVisible;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class DishDto
{
    public ?int $id = null;
    public string $name;
    public string $description;
    public float $price; // TODO: cast model property to float?
    public int $category_id;
    public mixed $sub_category_id = null;
    public ?int $order = null;
    public $is_visible; // TODO: fix type?
    public TemporaryUploadedFile|string|null $photo;

    public static function fromArray(array $data): self
    {

        $new = new self();
        $new->id = $data['id'] ?? null;
        $new->name = $data['name'];
        $new->description = (string)$data['description'];
        $new->price = $data['price'];
        $new->category_id = $data['category_id'];
        $new->sub_category_id = $data['sub_category_id'] > 0 ? $data['sub_category_id'] : null;
        $new->order = $data['order'] ?? null;
        $new->is_visible = $data['is_visible'];
        $new->photo = $data['photo'] ?? null;

        return $new;

    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id ?? null,
            'order' => $this->order,
            'is_visible' => $this->is_visible,
        ];
    }

}

