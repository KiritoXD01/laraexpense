<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * <p>Class RecordLabel</p>
 * This is the model class for table "record_labels"
 *
 * @property int    $id
 * @property string $name
 * @property string $color
 * @property int    $assign_to_new_records
 * @property int    $user_id
 * @property-read string $created_at
 * @property-read string $updated_at
 * @property-read string $deleted_at
 */
class RecordLabel extends Model
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
        'assign_to_new_records',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'assign_to_new_records' => 'boolean',
    ];

    /**
     * Relation between a label and its user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected static function booted(): void
    {
        static::creating(function (RecordLabel $recordLabel) {
            $recordLabel->user()->associate(auth()->user());
        });
    }
}
