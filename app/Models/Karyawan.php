<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    protected $fillable = [
        'nik', 'nama', 'nomor_hp', 'alamat', 'divisi_id'
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}
