<?php

namespace App\Http\Actions;

use App\Models\MenuSetting;
use App\Http\Dtos\MenuSettingDto;
use Illuminate\Support\Facades\DB;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateMenuSettingAction
{
    public function handle(MenuSettingDto $dto)
    {
        try {

            $menuSetting = DB::transaction(function () use ($dto) {


                $menuSetting = MenuSetting::updateOrCreate(
                    ['company_id' => $dto->company_id],
                    [
                        'primary_color' => $dto->primary_color,
                        'secondary_color' => $dto->secondary_color,
                        'tertiary_color' => $dto->tertiary_color,
                        'quaternary_color' => $dto->quaternary_color,
                        /* 'background_opacity' => $dto->backgroundOpacity, */
                        'title' => $dto->title,
                        'template' => $dto->template,
                        'selected_font' => $dto->selectedFont,
                        'selected_font_secondary' => $dto->selectedFontSecondary,
                        'text_footer' => $dto->textFooter,
                        'background_color' => $dto->background_color,
                    ]
                );



                /* if ($dto->newMenuWallpaper && $dto->newMenuWallpaper instanceof TemporaryUploadedFile) {
                    $menuSetting->addMedia($dto->newMenuWallpaper)->toMediaCollection('menu_wallpaper');
                } */

                return $menuSetting;
            });


        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }


        return $menuSetting;
    }
}
