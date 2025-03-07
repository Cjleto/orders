<?php

namespace App\Models;

use App\Interfaces\HasIncludableRelations;
use App\Interfaces\HasSortableFields;
use App\Traits\HasNameUcfirst;
use Spatie\MediaLibrary\HasMedia;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Attributes\UseFactory;

#[UseFactory(ProductFactory::class)]
class Product extends Model implements HasMedia, HasSortableFields, HasIncludableRelations
{

    use HasFactory, InteractsWithMedia, HasNameUcfirst;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];


    public function getSortableFields(): array
    {
        return ['id', 'name', 'price', 'stock', 'created_at'];
    }

    public function getIncludableRelations(): array
    {
        return ['orders'];
    }

    /** RELATIONSHIPS */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id')
            ->withPivot(['quantity', 'product_name', 'product_price'])
            ->withTimestamps();
    }

    public function items()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /** ACCESSORS */

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 2, ',', '.') . ' ' . config('myconst.currency_symbol');
    }

    public function setPriceAttribute($value): void
    {
        $this->attributes['price'] = round($value, 2);
    }

    public function getIsInStockAttribute(): bool
    {
        return $this->stock > 0;
    }

    /** LOCAL SCOPES */
    public function scopeInStock($query): Builder
    {
        return $query->where('stock', '>', 0);
    }

    /**RELATIONS */
    public function photo(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')->where('collection_name', 'photo');
    }

    /** MEDIA LIBRARY */
    public function registerMediaCollections(?Media $media = null): void
    {

        $this->addMediaCollection('photo')
            ->singleFile()
            ->useFallbackUrl('/img/nologo.jpeg');
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
}
