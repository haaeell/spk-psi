<?php
// app/Http/Controllers/SiswaController.php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        $kelasList = Siswa::distinct()->pluck('kelas');
        return view('siswa.index', compact('siswa','kelasList'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_siswa' => 'required|unique:siswa',
            'nisn' => 'required|unique:siswa',
            'nama_siswa' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')->with('success', 'Siswa created successfully.');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_siswa' => 'required|unique:siswa,kode_siswa,' . $id,
            'nisn' => 'required|unique:siswa,nisn,' . $id,
            'nama_siswa' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Siswa updated successfully.');
    }

    public function destroy($id)
    {
        Siswa::findOrFail($id)->delete();
        return redirect()->route('siswa.index')->with('success', 'Siswa deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diimpor.');
    }

    public function reset(Request $request)
{
    $kelas = $request->input('kelas');
    
    if ($kelas) {
        // Menghapus semua siswa di kelas yang dipilih
        Siswa::where('kelas', $kelas)->delete();
    }

    // Redirect ke halaman data siswa dengan pesan sukses
    return redirect()->route('siswa.index')->with('success', 'Data siswa di kelas ' . $kelas . ' telah direset.');
}
}

