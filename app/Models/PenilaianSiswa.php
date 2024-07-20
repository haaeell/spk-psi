<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSiswa extends Model
{
    use HasFactory;
    protected $table = 'penilaian_siswa';
    protected $fillable = ['kriteria_id', 'siswa_id', 'nilai'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
