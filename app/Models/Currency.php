<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * <p>Class Currency</p>
 * This is the model class for table "currencies"
 *
 * @property int    $id
 * @property string $iso
 * @property bool   $is_base_currency
 * @property int    $user_id
 * @property-read string $created_at
 * @property-read string $updated_at
 * @property-read string $deleted_at
 */
class Currency extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'iso',
        'is_base_currency',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_base_currency' => 'boolean',
    ];

    /**
     * Relation between a user and its currencies saved
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected static function booted(): void
    {
        static::creating(function (Currency $currency) {
            $currency->user()->associate(auth()->user());
        });
    }
}
