<?php

namespace App\Http\Dtos;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MenuSettingDto
{
    public ?int $id = null;
    public int $company_id;
    public string $title;
    public string $primary_color;
    public string $secondary_color;
    public string $tertiary_color;
    public string $quaternary_color;
    /* public ?Media $menuWallpaper = null;
    public ?TemporaryUploadedFile $newMenuWallpaper = null;
    public float $backgroundOpacity; */
    public string $template;
    public string $selectedFont;
    public string $selectedFontSecondary;
    public ?string $textFooter = null;
    public ?string $background_color = null;

    public function __construct(array $data)
    {
        $this->company_id = $data['company_id'] ?? throw new \InvalidArgumentException('Company ID is required');
        $this->primary_color = $data['primary_color'] ?? '';
        $this->secondary_color = $data['secondary_color'] ?? '';
        $this->tertiary_color = $data['tertiary_color'] ?? '';
        $this->quaternary_color = $data['quaternary_color'] ?? '';
        $this->title = $data['title'] ?? '';
        $this->template = $data['template'] ?? '';
        $this->selectedFont = $data['selectedFont'] ?? '';
        $this->selectedFontSecondary = $data['selectedFontSecondary'] ?? '';
        $this->textFooter = $data['textFooter'] ?? null;
        $this->background_color = $data['background_color'] ?? null;
        /* $this->backgroundOpacity = $data['backgroundOpacity'] ?? 1.0;
        $this->newMenuWallpaper = $data['newMenuWallpaper'] ?? null; */
    }

    public static function fromArray(array $data): self
    {
        $dto = new self($data);
        /* $dto->id = $data['id'] ?? null;
        $dto->company_id = $data['company_id'];
        $dto->title = $data['title'];
        $dto->primary_color = $data['primary_color'];
        $dto->secondary_color = $data['secondary_color'];
        $dto->menuWallpaper = $data['menuWallpaper'] ?? null;
        $dto->newMenuWallpaper = $data['newMenuWallpaper'] ?? null;
        $dto->backgroundOpacity = $data['backgroundOpacity'];
        $dto->template = $data['template'];
        $dto->selectedFont = $data['selectedFont']; */

        return $dto;
    }

}
