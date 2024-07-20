<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPerhitungan extends Model
{
    use HasFactory;
    protected $table = 'riwayat_perhitungan';

    protected $fillable = [
        'peringkat',
        'kode_siswa',
        'nama_siswa',
        'nilai_akhir',
        'tahun',
    ];
}
