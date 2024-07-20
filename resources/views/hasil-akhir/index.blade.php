@extends('layouts.app')

@section('title', 'Hasil Akhir')

@section('content')
<div class="">
    <div class="card">
        <div class="card-header">
           <h6 class="fw-semibold text-dark">
            Data Hasil Akhir Tahun Ini
           </h6>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Peringkat</th>
                        <th>Nama Siswa</th>
                        <th>Nilai PSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peringkat as $siswa_id => $data)
                    <tr>
                        <td>{{ $data['rank'] }}</td>
                        <td>{{ $data['nama'] }}</td>
                        <td>{{ number_format($data['nilai'], 9) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                <p>Berdasarkan hasil perhitungan, berikut adalah 3 siswa dengan nilai akhir tertinggi untuk diusulkan menjadi siswa berprestasi paralel tahun {{ date('Y') }}:</p>
                <ul>
                    @foreach($peringkatTertinggi as $data)
                        <li>
                            Peringkat {{ $data['rank'] }}: {{ $data['nama'] }} 
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('perhitungan.simpan') }}" class="btn btn-success float-end mt-3">Simpan Perhitungan</a>
            </div>
        </div>
    </div>
</div>
@endsection
