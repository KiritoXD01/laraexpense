<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * <p>Class RecordCategory</p>
 * This is the model class for table "record_categories"
 *
 * @property int    $id
 * @property string $name
 * @property bool   $is_active
 * @property int    $user_id
 * @property-read string $created_at
 * @property-read string $updated_at
 * @property-read string $deleted_at
 */
class RecordCategory extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'is_active',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relation between a record category and its user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected static function booted(): void
    {
        static::creating(function (RecordCategory $recordCategory) {
            $recordCategory->user()->associate(auth()->user());
        });
    }
}
