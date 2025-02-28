<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\LogsActivityWithImpersonation;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MenuSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, LogsActivityWithImpersonation;

    protected $fillable = [
        'primary_color',
        'secondary_color',
        'tertiary_color',
        'quaternary_color',
        'company_id',
        'title',
        'background_opacity',
        'template',
        'selected_font',
        'selected_font_secondary',
        'text_footer',
        'background_color',
    ];


    /** MEDIA LIBRARY */
    public function registerMediaCollections(?Media $media = null): void
    {

        $this->addMediaCollection('menu_wallpaper')
            ->singleFile();
            /* ->useFallbackUrl('/img/menu_nowallpaper.jpeg')
            ->useFallbackPath(public_path('/img/menu_nowallpaper.jpeg')); */
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('desktop')
            ->width(1920)
            ->height(1080)
            ->sharpen(10);

        $this->addMediaConversion('tablet')
            ->width(1280)
            ->height(800)
            ->sharpen(10);

        $this->addMediaConversion('mobile')
            ->width(768)
            ->height(1024)
            ->sharpen(10);

        $this->addMediaConversion('optimized')
            ->quality(80)
            ->optimize();

        $this->addMediaConversion('webp')
            ->format('webp');
    }

    /** RELATIONS */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function menuWallpaper(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')->where('collection_name', '=', 'menu_wallpaper');
    }
}
