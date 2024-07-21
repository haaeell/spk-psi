<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\PenilaianSiswa;
use App\Models\RiwayatPerhitungan;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        $kriteria = Kriteria::all();
        $penilaian = PenilaianSiswa::all();

        // Lakukan perhitungan PSI di sini
        $normalisasi = $this->normalisasi($penilaian, $kriteria);
        $mean = $this->calculateMean($normalisasi);
        $nilaiVariasi = $this->nilaiVariasi($normalisasi, $mean);
        $nilaiPenyimpangan = $this->nilaiPenyimpangan($nilaiVariasi);
        $bobotKriteria = $this->bobotKriteria($nilaiPenyimpangan);
        $perhitunganPSI = $this->perhitunganPSI($normalisasi, $bobotKriteria);

        arsort($perhitunganPSI);

        $peringkat = [];
        $rank = 1;
        foreach ($perhitunganPSI as $siswa_id => $nilai) {
            $peringkat[$siswa_id] = [
                'nama' => Siswa::find($siswa_id)->nama_siswa,
                'nilai' => $nilai,
                'rank' => $rank++
            ];
        }
        return view('perhitungan.index', compact('siswa', 'kriteria', 'penilaian', 'normalisasi', 'peringkat', 'bobotKriteria', 'perhitunganPSI', 'mean', 'nilaiVariasi', 'nilaiPenyimpangan'));
    }
    public function hasilAkhir()
{
    $siswa = Siswa::all();
    $kriteria = Kriteria::all();
    $penilaian = PenilaianSiswa::all();

    // Lakukan perhitungan PSI di sini
    $normalisasi = $this->normalisasi($penilaian, $kriteria);
    $mean = $this->calculateMean($normalisasi);
    $nilaiVariasi = $this->nilaiVariasi($normalisasi, $mean);
    $nilaiPenyimpangan = $this->nilaiPenyimpangan($nilaiVariasi);
    $bobotKriteria = $this->bobotKriteria($nilaiPenyimpangan);
    $perhitunganPSI = $this->perhitunganPSI($normalisasi, $bobotKriteria);

    arsort($perhitunganPSI);

    $peringkat = [];
    $rank = 1;
    foreach ($perhitunganPSI as $siswa_id => $nilai) {
        $peringkat[$siswa_id] = [
            'nama' => Siswa::find($siswa_id)->nama_siswa,
            'nilai' => $nilai,
            'rank' => $rank++
        ];
    }
    $peringkatTertinggi = array_slice($peringkat, 0, 3, true);

    return view('hasil-akhir.index', compact('peringkat', 'peringkatTertinggi'));
}
public function simpanPerhitungan()
{
    // Ambil data yang diperlukan
    $penilaian = PenilaianSiswa::all();
    $kriteria = Kriteria::all();

    // Lakukan perhitungan PSI di sini
    $normalisasi = $this->normalisasi($penilaian, $kriteria);
    $mean = $this->calculateMean($normalisasi);
    $nilaiVariasi = $this->nilaiVariasi($normalisasi, $mean);
    $nilaiPenyimpangan = $this->nilaiPenyimpangan($nilaiVariasi);
    $bobotKriteria = $this->bobotKriteria($nilaiPenyimpangan);
    $perhitunganPSI = $this->perhitunganPSI($normalisasi, $bobotKriteria);

    arsort($perhitunganPSI);

    $rank = 1;
    foreach ($perhitunganPSI as $siswa_id => $nilai) {
        RiwayatPerhitungan::create([
            'peringkat' => $rank++,
            'kode_siswa' => Siswa::find($siswa_id)->nisn,
            'nama_siswa' => Siswa::find($siswa_id)->nama_siswa,
            'nilai_akhir' => $nilai,
            'tahun' => date('Y')
        ]);
    }

    return redirect()->back()->with('success', 'Perhitungan berhasil disimpan.');
}

    private function normalisasi($penilaian, $kriteria)
    {
        $normalisasi = [];
        foreach ($kriteria as $k) {
            $nilaiMaks = $penilaian->where('kriteria_id', $k->id)->max('nilai');

            foreach ($penilaian->where('kriteria_id', $k->id) as $p) {
                $normalisasi[$p->siswa_id][$k->id] = $p->nilai / $nilaiMaks;
            }
        }
        return $normalisasi;
    }

    private function calculateMean($normalisasi)
    {
        $mean = [];
        $jumlahSiswa = count($normalisasi);

        // Hitung mean untuk setiap kriteriaa
        foreach ($normalisasi as $nilaiKriteria) {
            foreach ($nilaiKriteria as $kriteria_id => $nilai) {
                if (!isset($mean[$kriteria_id])) {
                    $mean[$kriteria_id] = 0;
                }
                $mean[$kriteria_id] += $nilai;
            }
        }

        // Rata-rata dari nilai total
        foreach ($mean as $kriteria_id => $total) {
            $mean[$kriteria_id] = $total / $jumlahSiswa;
        }

        return $mean;
    }
    private function nilaiVariasi($normalisasi, $mean)
    {
        $nilaiVariasi = [];
        foreach ($normalisasi as $siswa_id => $nilaiKriteria) {
            foreach ($nilaiKriteria as $kriteria_id => $nilai) {
                $selisih = $nilai - $mean[$kriteria_id];
                $kuadratSelisih = $selisih * $selisih;
                $nilaiVariasi[$siswa_id][$kriteria_id] = $kuadratSelisih;
            }
        }
        return $nilaiVariasi;
    }
    private function nilaiPenyimpangan($nilaiVariasi)
    {
        $nilaiPenyimpangan = [];

        // Inisialisasi array untuk menyimpan total variasi per kriteria
        $totalVariasiPerKriteria = [];

        // Jumlahkan nilai variasi per kriteria untuk setiap siswa
        foreach ($nilaiVariasi as $siswa_id => $variations) {
            foreach ($variations as $kriteria_id => $variasi) {
                if (!isset($totalVariasiPerKriteria[$kriteria_id])) {
                    $totalVariasiPerKriteria[$kriteria_id] = 0;
                }
                $totalVariasiPerKriteria[$kriteria_id] += $variasi;
            }
        }

        // Hitung penyimpangan untuk setiap kriteria
        foreach ($totalVariasiPerKriteria as $kriteria_id => $totalVariasi) {
            $nilaiPenyimpangan[$kriteria_id] = 1 - $totalVariasi;
        }

        return $nilaiPenyimpangan;
    }

    private function bobotKriteria($nilaiPenyimpangan)
    {
        $totalPenyimpangan = array_sum($nilaiPenyimpangan);
        $bobotKriteria = [];

        foreach ($nilaiPenyimpangan as $kriteria_id => $penyimpangan) {
            $bobotKriteria[$kriteria_id] = $penyimpangan / $totalPenyimpangan;
        }

        return $bobotKriteria;
    }

    private function perhitunganPSI($normalisasi, $bobotKriteria)
    {
        $perhitunganPSI = [];

        foreach ($normalisasi as $siswa_id => $nilaiKriteria) {
            $total = 0;
            foreach ($nilaiKriteria as $kriteria_id => $nilai) {
                $total += $nilai * $bobotKriteria[$kriteria_id];
            }
            $perhitunganPSI[$siswa_id] = $total;
        }

        return $perhitunganPSI;
    }

    public function riwayatPerhitungan(Request $request)
    {
        $tahunFilter = $request->input('tahun');
        $query = RiwayatPerhitungan::query();
    
        if ($tahunFilter) {
            $query->where('tahun', $tahunFilter);
        }
    
        $riwayatPerhitungan = $query->orderBy('tahun', 'desc')->orderBy('peringkat')->get();
    
        // Ambil daftar tahun untuk dropdow
        $tahunList = RiwayatPerhitungan::distinct()->pluck('tahun');
    
        return view('riwayat-perhitungan.index', compact('riwayatPerhitungan', 'tahunList'));
    }

    public function cetakPdf(Request $request)
    {
        $tahunFilter = $request->input('tahun');
        $query = RiwayatPerhitungan::query();
    
        if ($tahunFilter) {
            $query->where('tahun', $tahunFilter);
        }
    
        $riwayatPerhitungan = $query->orderBy('peringkat')->get();
    
        $pdf = Pdf::loadView('riwayat-perhitungan.pdf', [
            'riwayat_perhitungan' => $riwayatPerhitungan,
            'filter_tahun' => $tahunFilter
        ]);
        return $pdf->download('riwayat_perhitungan.pdf');
    }

}
