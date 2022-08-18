<?php

namespace App\Models;

use App\Enums\RecordTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * <p>Class Record</p>
 * This is the model class for table "records"
 *
 * @property int    $id
 * @property string $type
 * @property int    $account_id
 * @property float  $amount
 * @property int    $currency_id
 * @property string $paid_at
 * @property-read string $created_at
 * @property-read string $updated_at
 * @property-read string $deleted_at
 */
class Record extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'account_id',
        'amount',
        'currency_id',
        'paid_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => RecordTypeEnum::class,
        'paid_at' => 'datetime',
        'amount' => 'float'
    ];

    /**
     * Relation between a record and its user
     *
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    /**
     * Relation between a record and its currency
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }
}
