<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $fillable = [
        'email',
        'password_hash',
        'nama_user',
        'phone_number',
        'role_id',
        'alamat',
    ];

    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id');
    }

    public function reservations()
    {
        return $this->hasMany(ReservasiModel::class, 'user_id');
    }
}
