<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
    ];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}