<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamanBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'pinjaman_id',
        'barang_id',
        'tanggal_peminjaman',
        'tanggal_pengembalian'
    ];

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
