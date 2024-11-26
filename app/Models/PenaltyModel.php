<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenaltyModel extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'penalty';
    protected $fillable = [
        'pengembalian_id',
        'jumlah',
        'deskripsi',
    ];

    public function pengembalian()
    {
        return $this->belongsTo(PengembalianModel::class, 'pengembalian_id');
    }
}
