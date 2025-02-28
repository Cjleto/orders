<?php

namespace App\Models;

use App\Enums\IsVisible;
use App\Traits\HasNameUcfirst;
use App\Traits\HasTranslations;
use App\Traits\HasAutomaticOrder;
use App\Interfaces\TranslatableInterface;
use App\Traits\LogsActivityWithImpersonation;
use App\Interfaces\HasAutomaticOrderInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $macro_category_id
 * @property int $order
 * @property IsVisible $is_visible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dish> $dishes
 * @property-read int|null $dishes_count
 * @property-read \App\Models\MacroCategory $macroCategory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubCategory> $subCategories
 * @property-read int|null $sub_categories_count
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereMacroCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends BaseCategory implements HasAutomaticOrderInterface, TranslatableInterface
{
    use HasFactory,
        HasAutomaticOrder,
        HasNameUcfirst,
        LogsActivityWithImpersonation,
        HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'macro_category_id',
        'order',
        'is_visible',
        'hide_price'
    ];

    protected $translatable = [
        'name',
        'description',
    ];

    protected $casts = [
        'is_visible' => IsVisible::class,
    ];


    public function getTranslationPath(): string
    {

        return 'categories/' . $this->id;
    }

    public function getTranslatableFields()
    {
        return $this->translatable;
    }

    public function getMaxOrder(): int
    {
        return $this->macroCategory?->categories?->max('order') ?? 0;
    }


    /** SCOPES */
    public function scopeVisible($query)
    {
        return $query->where($query->qualifyColumn('is_visible'), IsVisible::VISIBLE);
    }

    /** RELATIONS */
    public function macroCategory(): BelongsTo
    {
        return $this->belongsTo(MacroCategory::class)
            ->orderBy('order');
    }

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class)
            ->orderBy('order');
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class)
            ->orderBy('order');
    }

    public function company(): HasOneThrough
    {
        return $this->hasOneThrough(
            Company::class,        // Il modello finale che vuoi ottenere
            MacroCategory::class,  // Il modello intermedio più vicino
            'id',                  // La chiave esterna di MacroCategory in Category
            'id',                  // La chiave esterna di Company in MacroCategory
            'macro_category_id',   // La chiave esterna di Category in Dish
            'company_id'           // La chiave esterna di MacroCategory in Company
        );
    }

}
