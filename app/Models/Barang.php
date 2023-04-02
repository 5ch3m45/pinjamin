<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'bnm_nup',
        'nama',
        'merk',
        'tanggal_perolehan',
        'jumlah',
        'keterangan',
        'qr',
        'kondisi',
        'foto',
        'lokasi_id'
    ];

    public function fotos() {
        return $this->hasMany(FotoBarang::class);
    }

    public function lokasi() {
        return $this->belongsTo(Lokasi::class);
    }

    public function getKondisiTextAttribute()
    {
        if($this->kondisi == 'rusak_ringan') {
            return 'Rusak ringan';
        } elseif($this->kondisi == 'rusak_berat') {
            return 'Rusak berat';
        } else {
            return 'Baik';
        }
    }

    public function getDipinjamAttribute()
    {
        return PinjamanBarang::where('barang_id', $this->id)
            ->where('tanggal_peminjaman', '>', '1970-01-01')
            ->where('tanggal_pengembalian', '=', NULL)
            ->count();
    }

    public function getStatusAttribute()
    {
        if($this->jumlah) {
            if($this->jumlah > $this->dipinjam) {
                return 'Barang Tersedia';
            } else {
                return 'Sedang Dipinjam';
            }
        } else {
            return 'Barang Tidak Ada';
        }
    }
}
