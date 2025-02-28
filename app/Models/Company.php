<?php

namespace App\Models;

use App\Enums\CompanyType;
use App\Models\MenuSetting;
use App\Enums\CompanyStatus;
use App\Traits\HasNameUcfirst;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\LogsActivityWithImpersonation;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $slug
 * @property \Illuminate\Support\Carbon $expiration_date
 * @property int $user_id
 * @property CompanyStatus $status
 * @property CompanyType $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MacroCategory> $macroCategories
 * @property-read int|null $macro_categories_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\CompanyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Company forAuthUser()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUserId($value)
 * @mixin \Eloquent
 */
class Company extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasNameUcfirst, LogsActivityWithImpersonation;

    protected $fillable = [
        'name',
        'description',
        'address',
        'slug',
        'expiration_date',
        'status',
        'user_id',
        'type',
        'google_review_link',
        'facebook_link',
        'instagram_link',
        'site_link',
    ];

    protected $casts = [
        'expiration_date' => 'datetime',
        'status' => CompanyStatus::class,
        'type' => CompanyType::class
    ];

    /** MEDIA LIBRARY */
    public function registerMediaCollections(?Media $media = null): void
    {

        $this->addMediaCollection('logo')
            ->singleFile();
            /* ->useFallbackUrl('/img/nologo.jpeg'); */
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->performOnCollections('logo')
            ->keepOriginalImageFormat()
            ->width(368)
            ->height(232)
            ->nonQueued();

        $this->addMediaConversion('thumb_sharp')
            ->performOnCollections('logo')
            ->keepOriginalImageFormat()
            ->width(100)
            ->sharpen(10)
            ->nonQueued();
    }

    /** RELATIONS */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function macroCategories(): HasMany
    {
        return $this->hasMany(MacroCategory::class)
            ->orderBy('order');
    }

    public function menuSetting(): HasOne
    {
        return $this->hasOne(MenuSetting::class);
    }

    /** SCOPE */
    public function scopeForAuthUser($builder): void
    {
        $user = Auth::user();

        if ($user->hasRole('manager')) {
            // Filtra per l'azienda dell'utente manager
            $builder->where('user_id', $user->id);
        }
    }


    /** FUNCTIONS */
    public function isExpired(): bool
    {
        return $this->expiration_date && $this->expiration_date->isPast();
    }

    public function isActive(): bool
    {
        return $this->status === CompanyStatus::ACTIVE;
    }

    public function remainingDays(): ?int
    {
        if (! $this->expiration_date) {
            return null;
        }

        return (int) now()->diffInDays($this->expiration_date, true);
    }

    public function isExpiringInAMonth(): bool
    {
        return $this->remainingDays() <= 30;
    }
}
