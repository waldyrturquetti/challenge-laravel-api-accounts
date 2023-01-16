<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\models
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $birthday
 * @property string $cpf
 * @property string uuid
 * @property bool $active
 */
class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'id', 'name', 'email', 'birthday', 'cpf', 'uuid', 'active' ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [ 'created_at', 'updated_at' ];
}
