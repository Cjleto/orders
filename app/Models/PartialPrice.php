<?php

namespace App\Models;

use App\Traits\HasAutomaticOrder;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivityWithImpersonation;
use App\Interfaces\HasAutomaticOrderInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property int $id
 * @property int $dish_id
 * @property string $price
 * @property string $label
 * @property string $is_visible
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Dish $dish
 * @method static \Database\Factories\PartialPriceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PartialPrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartialPrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartialPrice query()
 * @method static \Illuminate\Database\Eloquent\Builder|PartialPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartialPrice whereDishId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartialPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartialPrice whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartialPrice whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartialPrice whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartialPrice wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartialPrice whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PartialPrice extends Model
{
    use HasFactory, LogsActivityWithImpersonation;

    protected $fillable = [
        'dish_id',
        'price',
        'label',
    ];

    /** RELATIONS */
    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class);
    }
}
