<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiModel extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'reservasi';
    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'total_harga',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function car()
    {
        return $this->belongsTo(CarModel::class, 'car_id');
    }

    public function pembayaran()
    {
        return $this->hasOne(PembayaranModel::class, 'reservasi_id');
    }
}
