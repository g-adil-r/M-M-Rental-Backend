<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisMobilModel extends Model
{
    use HasFactory;

    protected $table = 'jenis_mobil';
    protected $fillable = ['jenis'];

    public function cars()
    {
        return $this->hasMany(CarModel::class, 'id_jenis');
    }
}
