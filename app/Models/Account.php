<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Account
 * @package App\models
 * @property int $id
 * @property string $user_name
 * @property double $credits
 * @property string $type
 * @property boolean $active
 * @property int $user_id
 */
class Account extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'id', 'user_name', 'credits', 'type', 'active', 'user_id' ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [ 'created_at', 'updated_at' ];

    public const PERSONAL_ACCOUNT = 'personal_account';
    public const BUSINESS_ACCOUNT = 'business_account';

    public const ALL_TYPES = [
        self::PERSONAL_ACCOUNT,
        self::BUSINESS_ACCOUNT,
    ];
}
