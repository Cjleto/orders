<?php

namespace App\Http\Dtos;

use App\Enums\IsVisible;

class SubCategoryDto
{
    public string $name;
    public string $description;
    public ?int $order = null;
    public $is_visible;

    public static function fromArray(array $data): self
    {
        $new = new self();
        $new->name = $data['name'];
        $new->description = $data['description'];
        $new->order = $data['order'] ?? null;
        $new->is_visible = $data['is_visible'];

        return $new;

    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'order' => $this->order,
            'is_visible' => $this->is_visible,
        ];
    }

}

