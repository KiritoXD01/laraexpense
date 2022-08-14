<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * <p>Class User</p>
 * This is the model class for table "users"
 *
 * @property int    $id
 * @property string $name
 * @property string $email
 * @property string $email_verified_at
 * @property-read string $created_at
 * @property-read string $updated_at
 * @property-read string $deleted_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relation between a user and its record categories
     *
     * @return HasMany
     */
    public function recordCategories(): HasMany
    {
        return $this->hasMany(RecordCategory::class, 'user_id', 'id');
    }

    /**
     * Relation between a user and its currencies saved
     *
     * @return HasMany
     */
    public function currencies(): HasMany
    {
        return $this->hasMany(Currency::class, 'user_id', 'id');
    }

    /**
     * Relation between a user and its accounts created
     *
     * @return HasMany
     */
    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class, 'user_id', 'id');
    }
}
