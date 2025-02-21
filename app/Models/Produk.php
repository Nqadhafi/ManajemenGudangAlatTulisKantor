<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = [
         'nama_produk', 'kategori_id', 'satuan', 'stok' ,'stok_minimum'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
