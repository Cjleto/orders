<?php

namespace App\Models;

use App\Enums\IsVisible;
use GuzzleHttp\Promise\Is;
use App\Traits\HasTranslations;
use App\Traits\HasAutomaticOrder;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\TranslatableInterface;
use App\Traits\LogsActivityWithImpersonation;
use App\Interfaces\HasAutomaticOrderInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $order
 * @property IsVisible $is_visible
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dish> $dishes
 * @property-read int|null $dishes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubCategory> $subCategories
 * @property-read int|null $sub_categories_count
 * @method static \Database\Factories\MacroCategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|MacroCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MacroCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MacroCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|MacroCategory visible()
 * @method static \Illuminate\Database\Eloquent\Builder|MacroCategory whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacroCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacroCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacroCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacroCategory whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacroCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacroCategory whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacroCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MacroCategory extends BaseCategory implements HasAutomaticOrderInterface, TranslatableInterface
{
    use HasFactory, HasAutomaticOrder, LogsActivityWithImpersonation, HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'company_id',
        'is_visible',
        'order'
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
        return 'macro_categories/' . $this->id;
    }

    public function getTranslatableFields()
    {
        return $this->translatable;
    }


    public function getMaxOrder(): int
    {
        return $this->company?->macroCategories?->max('order') ?? 0;
    }

    /** SCOPES */
    public function scopeVisible($query)
    {
        return $query->where($query->qualifyColumn('is_visible'), IsVisible::VISIBLE);
    }

    /** RELATIONS */
    public function dishes(): HasManyThrough
    {
        return $this->HasManyThrough(Dish::class, Category::class)
            ->orderBy('order');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class)
            ->chaperone('macroCategory')
            ->orderBy('order');
    }

    public function subCategories(): HasManyThrough
    {
        return $this->hasManyThrough(SubCategory::class, Category::class)
            ->orderBy('order');
    }


}
