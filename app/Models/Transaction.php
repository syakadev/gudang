<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'catatan',
        'tanggal',
        'total_harga',
        'alamat_pengiriman',
        'jenis_transaksi',
        'user_id',
        'pelanggan_id',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
        'total_harga' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}