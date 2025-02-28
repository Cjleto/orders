<?php

namespace App\Models;

use Debugbar;
use App\Enums\IsVisible;
use App\Enums\LanguageEnum;
use App\Traits\HasNameUcfirst;
use App\Traits\HasTranslations;
use App\Traits\HasAutomaticOrder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use App\Interfaces\TranslatableInterface;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\LogsActivityWithImpersonation;
use App\Interfaces\HasAutomaticOrderInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $price
 * @property int $category_id
 * @property int $sub_category_id
 * @property int $is_visible
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PartialPrice> $partialPrices
 * @property-read int|null $partial_prices_count
 * @property-read \App\Models\SubCategory $subCategory
 * @method static \Database\Factories\DishFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Dish newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dish newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dish query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Dish extends Model implements HasAutomaticOrderInterface, HasMedia, TranslatableInterface
{
    use HasFactory,
        HasAutomaticOrder,
        HasNameUcfirst,
        InteractsWithMedia,
        LogsActivityWithImpersonation,
        HasTranslations;

    protected $table = 'dishes';

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'sub_category_id',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => IsVisible::class,
    ];

    protected $translatable = [
        'name',
        'description',
    ];

    protected $with = ['category'];

    public function getTranslationPath (): string
    {

        return 'dishes/'.$this->id;
    }

    public function getTranslatedNameAttribute(): string
    {
        return $this->getTranslatedValue('name');
    }


    public function getMaxOrder(): int
    {
        return $this->category?->dishes?->max('order') ?? 0;
    }

    public function getTranslatableFields ()
    {
        return $this->translatable;
    }

    /** MEDIA LIBRARY */
    public function registerMediaCollections(?Media $media = null): void
    {

        $this->addMediaCollection('photo')
            ->singleFile();
            /* ->useFallbackUrl('/img/nologo.jpeg'); */
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
        ->performOnCollections('photo')
        ->keepOriginalImageFormat()
            ->width(200)
            ->height(200)
            ->nonQueued();

        $this->addMediaConversion('squared')
        ->performOnCollections('photo')
        ->keepOriginalImageFormat()
            ->width(50)
            ->height(50)
            ->nonQueued();
    }

    /** SCOPES */
    public function scopeVisible($query)
    {
        return $query->where($query->qualifyColumn('is_visible'), IsVisible::VISIBLE);
    }

    public function scopeUnvisible ($query)
    {
        return $query->where($query->qualifyColumn('is_visible'), IsVisible::INVISIBLE);
    }

    /** RELATIONS */

    public function macroCategory(): HasOneThrough
    {
        return $this->hasOneThrough(MacroCategory::class, Category::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)
            ->orderBy('order');
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class)
            ->orderBy('order');
    }

    public function allergens(): BelongsToMany
    {
        return $this->belongsToMany(Allergen::class)
            ->orderBy('name')
            ->withTimestamps();
    }

    public function peculiarities(): BelongsToMany
    {
        return $this->belongsToMany(Peculiarity::class)
            ->orderBy('name')
            ->withTimestamps();
    }

    public function partialPrices(): HasMany
    {
        return $this->hasMany(PartialPrice::class);
    }

    public function photo(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')->where('collection_name', '=', 'photo');
    }

    public function translations (): MorphMany
    {
        return $this->morphMany(Translation::class, 'translatable')
            ->whereIn('locale', LanguageEnum::cases());
    }

    public function translate($field, $locale = 'en'): string
    {
        $translation = $this->translations()->where('field', $field)->where('locale', $locale)->first();
        return $translation ? $translation->value : $this->$field;
    }

}
