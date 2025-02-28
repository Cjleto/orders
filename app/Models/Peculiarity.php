<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Peculiarity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Peculiarity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Peculiarity query()
 * @mixin \Eloquent
 */
class Peculiarity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
    ];
}
