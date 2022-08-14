<?php

namespace App\Models;

use App\Enums\AccountTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * <p>Class Account</p>
 * This is the model class for table "accounts"
 *
 * @property int    $id
 * @property string $name
 * @property string $color
 * @property string $type
 * @property float  $starting_amount
 * @property int    $currency_id
 * @property int    $user_id
 * @property-read string $created_at
 * @property-read string $updated_at
 * @property-read string $deleted_at
 */
class Account extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'color',
        'type',
        'starting_amount',
        'currency_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => AccountTypeEnum::class,
    ];

    /**
     * Relation between an account and its user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relation between an account and its currency
     *
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    protected static function booted(): void
    {
        static::creating(function (Account $account) {
            $account->user()->associate(auth()->user());
        });
    }
}
