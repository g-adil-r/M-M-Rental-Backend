<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusModel extends Model
{
    use HasFactory;

    protected $table = 'status'; // Nama tabel tunggal
    protected $fillable = ['status'];

    public function cars()
    {
        return $this->hasMany(CarModel::class, 'status_id');
    }
}
