<?php

namespace App\Models;

use App\Enums\RecordTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'type' => RecordTypeEnum::class,
        'paid_at' => 'datetime'
    ];
}
