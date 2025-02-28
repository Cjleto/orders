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

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $category_id
 * @property int $order
 * @property IsVisible $is_visible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dish> $dishes
 * @property-read int|null $dishes_count
 * @method static \Database\Factories\SubCategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SubCategory extends BaseCategory implements HasAutomaticOrderInterface, TranslatableInterface
{
    use HasFactory, HasAutomaticOrder, HasNameUcfirst, LogsActivityWithImpersonation, HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'order',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => IsVisible::class,
    ];

    protected $translatable = [
        'name',
        'description',
    ];

    public function getTranslationPath(): string
    {

        return 'sub_categories/' . $this->id;
    }

    public function getTranslatableFields()
    {
        return $this->translatable;
    }

    public function getMaxOrder(): int
    {
        return $this->category?->subCategories?->max('order') ?? 0;
    }

    /** SCOPES */
    public function scopeVisible($query)
    {
        return $query->where($query->qualifyColumn('is_visible'), IsVisible::VISIBLE);
    }

    /** RELATIONS */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)
            ->orderBy('order');
    }

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class)
            ->orderBy('order');
    }
}
