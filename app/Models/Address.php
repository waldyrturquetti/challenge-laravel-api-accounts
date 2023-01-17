<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Address
 * @package App\models
 * @property int $id
 * @property string $zip_code
 * @property string $street
 * @property string $complement
 * @property string $neighborhood
 * @property string $city
 * @property string $uf
 * @property int $user_id
 */
class Address extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'id', 'zip_code', 'street', 'complement', 'neighborhood', 'city', 'uf', 'user_id' ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [ 'created_at', 'updated_at' ];
}
