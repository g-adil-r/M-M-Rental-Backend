<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianModel extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'pengembalian'; // Nama tabel tunggal
    protected $fillable = [
        'reservasi_id',
        'tanggal_pengembalian',
        'kondisi',
    ];

    public function reservasi()
    {
        return $this->belongsTo(ReservasiModel::class, 'reservasi_id');
    }

    public function penalties()
    {
        return $this->hasMany(PenaltyModel::class, 'pengembalian_id');
    }
}
