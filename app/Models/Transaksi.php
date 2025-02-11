<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'jenis_transaksi', 'produk_id', 'jumlah', 'tanggal_transaksi' , 'nik_karyawan' , 'keterangan'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nik_karyawan', 'nik');
    }
    
}
