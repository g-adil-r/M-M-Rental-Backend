<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaranModel extends Model
{
    use HasFactory;

    protected $table = 'metode_pembayaran';
    protected $fillable = ['nama_metode'];

    public function pembayarans()
    {
        return $this->hasMany(PembayaranModel::class, 'metode_pembayaran_id');
    }
}
