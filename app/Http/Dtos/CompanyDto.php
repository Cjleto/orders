<?php

namespace App\Http\Dtos;

use App\Enums\CompanyType;
use DateTime;
use Carbon\Carbon;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

readonly class CompanyDto
{
    public string $name;
    public ?string $description;
    public string $address;
    public ?TemporaryUploadedFile $logo;
    public string $slug;
    public Carbon $expiration_date;
    public int $user_id;
    public CompanyType $type;
    public ?string $google_review_link;
    public ?string $facebook_link;
    public ?string $instagram_link;
    public ?string $site_link;

    public static function fromRequest(array $data): self
    {
        $dto = new self();
        $dto->name = $data['name'];
        $dto->description = $data['description'];
        $dto->address = $data['address'];
        $dto->logo = $data['logo'];
        $dto->slug = $data['slug'];
        $dto->expiration_date = $data['expiration_date'];
        $dto->user_id = $data['user_id'];
        $dto->type = $data['type'];
        $dto->google_review_link = $data['google_review_link'];
        $dto->facebook_link = $data['facebook_link'];
        $dto->instagram_link = $data['instagram_link'];
        $dto->site_link = $data['site_link'];

        return $dto;
    }

    public function toArrayOfAttributes(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'slug' => $this->slug,
            'expiration_date' => $this->expiration_date->format('Y-m-d'),
            /* 'logo' => $this->logo, */
            'user_id' => $this->user_id,
            'type' => $this->type,
            'google_review_link' => $this->google_review_link,
            'facebook_link' => $this->facebook_link,
            'instagram_link' => $this->instagram_link,
            'site_link' => $this->site_link,
        ];
    }
}
