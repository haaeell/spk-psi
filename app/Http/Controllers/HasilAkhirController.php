<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HasilAkhirController extends Controller
{
    public function index()
    {
        return view('hasil-akhir.index');
    }
}
