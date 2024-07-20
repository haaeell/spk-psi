@extends('layouts.app')

@section('title', 'Riwayat Perhitungan')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h6 class="fw-semibold text-dark">
                Riwayat Perhitungan
            </h6>
        </div>
        <div class="card-body">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('riwayat.perhitungan') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <select name="tahun" id="tahun" class="form-control">
                                        <option value="">-- Pilih Tahun --</option>
                                        @foreach($tahunList as $tahun)
                                            <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                                {{ $tahun }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary mt-4">Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-end">
                        <a href="{{ route('riwayat.perhitungan.pdf', ['tahun' => request('tahun')]) }}" class="btn btn-primary mt-4">
                            Cetak PDF
                        </a>
                    </div>
                </div>
            </form>

            <!-- Data Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Peringkat</th>
                        <th>Kode Siswa</th>
                        <th>Nama Siswa</th>
                        <th>Nilai Akhir</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayatPerhitungan as $riwayat)
                    <tr>
                        <td>{{ $riwayat->peringkat }}</td>
                        <td>{{ $riwayat->kode_siswa }}</td>
                        <td>{{ $riwayat->nama_siswa }}</td>
                        <td>{{ number_format($riwayat->nilai_akhir, 9) }}</td>
                        <td>{{ $riwayat->tahun }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Keterangan 3 Peringkat Atas -->
            <div class="mt-4">
                <p>Berdasarkan hasil perhitungan, berikut adalah 3 siswa dengan nilai akhir tertinggi untuk diusulkan menjadi siswa berprestasi paralel tahun {{ request('tahun') ?? date('Y') }}:</p>
                <ul>
                    @foreach ($riwayatPerhitungan->take(3) as $row)
                        <li>{{ $row->nama_siswa }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
