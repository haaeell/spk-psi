<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\PenilaianSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PenilaianSiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        $kriteria = Kriteria::all();
        $penilaian = PenilaianSiswa::all();
        return view('penilaian.index', compact('siswa', 'kriteria', 'penilaian'));
    }

    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kriteria = Kriteria::all();
        $penilaian = PenilaianSiswa::where('siswa_id', $id)->get();
        return view('penilaian.show', compact('siswa', 'kriteria', 'penilaian'));
    }

    public function create($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kriteria = Kriteria::all();
        return view('penilaian.create', compact('siswa', 'kriteria'));
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|numeric',
            'kriteria_id' => 'required|exists:kriterias,id',
        ]);

        $penilaian = new PenilaianSiswa();
        $penilaian->siswa_id = $id;
        $penilaian->kriteria_id = $request->kriteria_id;
        $penilaian->nilai = $request->nilai;
        $penilaian->save();

        return redirect()->route('penilaian.index')->with('success', 'Nilai berhasil disimpan');
    }

    public function edit($siswa_id)
    {
        $siswa = Siswa::find($siswa_id);
        $kriteria = Kriteria::all();
        $penilaian = PenilaianSiswa::where('siswa_id', $siswa_id)->get();

        return view('penilaian.edit', compact('siswa', 'kriteria', 'penilaian'));
    }

    public function createOrUpdate(Request $request)
    {
        $data = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'kriteria' => 'required|array',
            'kriteria.*.nilai' => 'required|integer',
        ]);
    
        foreach ($data['kriteria'] as $kriteria_id => $kriteria_data) {
            PenilaianSiswa::updateOrCreate(
                ['siswa_id' => $data['siswa_id'], 'kriteria_id' => $kriteria_id],
                ['nilai' => $kriteria_data['nilai']]
            );
        }
    
        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui');
    }
}
