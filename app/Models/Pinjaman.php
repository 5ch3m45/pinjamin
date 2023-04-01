<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = 'pinjamans';

    protected $fillable = [
        'kode',
        'tanggal_pengajuan',
        'tanggal_peminjaman',
        'rencana_pengembalian',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function pinjaman_barangs()
    {
        return $this->hasMany(PinjamanBarang::class);
    }

    public function getStatusAttribute()
    {
        $barang_belum_disetujui = $this->pinjaman_barangs()
            ->where('tanggal_peminjaman', '=', NULL)
            ->count();
        $barang_dipinjam = $this->pinjaman_barangs()
            ->where('tanggal_peminjaman', '>', '1970-01-01')
            ->count();
        $barang_belum_dikembalikan = $this->pinjaman_barangs()
            ->where('tanggal_peminjaman', '>', '1970-01-01')
            ->where('tanggal_pengembalian', null)
            ->count();

        if($barang_belum_disetujui && !$barang_dipinjam) {
            return 'BELUM DISETUJUI';
        }

        if(!$barang_dipinjam) {
            return 'TIDAK ADA BARANG';
        }

        if(!$barang_belum_dikembalikan) {
            return '<span class="text-success">DIKEMBALIKAN SEMUA</span>';
        }

        if($barang_belum_dikembalikan < $barang_dipinjam) {
            $date1 = new DateTime();
            $date2 = new DateTime($this->rencana_pengembalian);
            $interval = $date1->diff($date2);
            if($interval < 0) {
                return 'DIKEMBALIKAN SEBAGIAN';
            }
            return '<span class="text-danger">DIKEMBALIKAN SEBAGIAN, TELAT PENGEMBALIAN</span>';
        }
        
        if($barang_belum_dikembalikan == $barang_dipinjam) {
            $date1 = new \DateTime();
            $date2 = new \DateTime($this->rencana_pengembalian);
            $interval = $date1->diff($date2)->format('%R%a');
            if((int)$interval < 0) {
                return '<span class="text-danger">BELUM DIKEMBALIKAN, TELAT PENGEMBALIAN</span>';
            }
            return 'SEDANG DIPINJAM';
        }

        return 'MENUNGGU KONFIRMASI';
    }

    public function getStatusPeminjamAttribute()
    {
        $barang_dipinjam = $this->pinjaman_barangs()
            ->where('tanggal_peminjaman', '>', '1970-01-01')
            ->count();
        $barang_belum_dikembalikan = $this->pinjaman_barangs()
            ->where('tanggal_peminjaman', '>', '1970-01-01')
            ->where('tanggal_pengembalian', null)
            ->count();

        if(!$barang_dipinjam) {
            return 'BELUM DIKONFIRMASI ADMIN';
        }

        if(!$barang_belum_dikembalikan) {
            return 'DIKEMBALIKAN SEMUA';
        }

        if($barang_belum_dikembalikan < $barang_dipinjam) {
            return 'DIKEMBALIKAN SEBAGIAN';
        }
        
        if($barang_belum_dikembalikan == $barang_dipinjam) {
            return 'SEDANG DIPINJAM';
        }

        return 'MENUNGGU KONFIRMASI';
    }
}
