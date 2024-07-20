<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (empty($row['kode_siswa']) || empty($row['nisn']) || empty($row['nama_siswa']) || empty($row['kelas']) || !in_array($row['jenis_kelamin'], ['L', 'P'])) {
            return null; 
        }
        return new Siswa([
            'kode_siswa' => $row['kode_siswa'],
            'nisn' => $row['nisn'],
            'nama_siswa' => $row['nama_siswa'],
            'kelas' => $row['kelas'],
            'jenis_kelamin' => $this->convertJenisKelamin($row['jenis_kelamin']),
        ]);
    }

    /**
     * Konversi kode jenis kelamin menjadi deskripsi.
     *
     * @param  string  $jenisKelamin
     * @return string
     */
    protected function convertJenisKelamin($jenisKelamin)
    {
        return $jenisKelamin === 'L' ? 'Laki-laki' : ($jenisKelamin === 'P' ? 'Perempuan' : null);
    }
}
