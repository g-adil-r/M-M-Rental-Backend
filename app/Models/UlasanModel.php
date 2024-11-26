<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasanModel extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'ulasan'; // Nama tabel tunggal
    protected $fillable = [
        'user_id',
        'car_id',
        'rating',
        'komentar',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function car()
    {
        return $this->belongsTo(CarModel::class, 'car_id');
    }
}
