<?php

namespace App\Http\Dtos;

use App\Enums\IsVisible;

class CategoryDto
{
    public string $name;
    public string $description;
    public ?int $order = null;
    public $is_visible;
    public $hide_price;

    public static function fromArray(array $data): self
    {
        $new = new self();
        $new->name = $data['name'];
        $new->description = $data['description'];
        $new->order = $data['order'] ?? null;
        $new->is_visible = $data['is_visible'];
        $new->hide_price = $data['hide_price'];

        return $new;

    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'order' => $this->order,
            'is_visible' => $this->is_visible,
            'hide_price' => $this->hide_price,
        ];
    }

}

