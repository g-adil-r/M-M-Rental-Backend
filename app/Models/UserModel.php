<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasUuid;

    protected $table = 'user';

    protected $fillable = [
        'email',
        'password_hash',
        'nama_user',
        'phone_number',
        'role_id',
        'alamat',
    ];

    protected $hidden = [
        'password_hash',
    ];

    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id');
    }

    public function reservations()
    {
        return $this->hasMany(ReservasiModel::class, 'user_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}
