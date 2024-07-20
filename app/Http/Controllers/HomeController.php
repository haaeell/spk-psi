<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $siswaCount = \App\Models\Siswa::count();
        $kriteriaCount = \App\Models\Kriteria::count();
        $penilaianSiswaCount = \App\Models\PenilaianSiswa::count();
        return view('home', compact('siswaCount', 'kriteriaCount', 'penilaianSiswaCount'));
    }
}
