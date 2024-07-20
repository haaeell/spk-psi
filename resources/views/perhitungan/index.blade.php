@extends('layouts.app')
@section('title', 'Perhitungan')
@section('content')
<div class="container">
    <!-- Data Alternatif (Siswa) -->
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary d-block" type="button" data-bs-toggle="collapse" data-bs-target="#dataAlternatif" aria-expanded="false" aria-controls="dataAlternatif">
                 Data Alternatif (Siswa)
            </button>
        </div>
        <div class="collapse" id="dataAlternatif">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>NISN</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->nama_siswa }}</td>
                            <td>{{ $s->kelas }}</td>
                            <td>{{ $s->nisn }}</td>
                            <td>{{ $s->jenis_kelamin }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Data Alternatif (Kriteria) --}}
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary d-block" type="button" data-bs-toggle="collapse" data-bs-target="#dataAlternatifKriteria" aria-expanded="false" aria-controls="dataAlternatif">
                 Data Alternatif (Kriteria)
            </button>
        </div>
        <div class="collapse" id="dataAlternatifKriteria">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            @foreach($kriteria as $kr)
                                <th>{{ $kr->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $sw)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sw->nama_siswa }}</td>
                                @foreach($kriteria as $kr)
                                    @php
                                        $nilai = $penilaian->where('siswa_id', $sw->id)->where('kriteria_id', $kr->id)->first();
                                    @endphp
                                    <td>
                                        @if ($kr->kode_kriteria == 'C2' || $kr->kode_kriteria == 'C3')
                                            @php
                                                $descriptions = [
                                                    1 => 'MB (Mulai Berkembang)',
                                                    2 => 'B (Berkembang)',
                                                    3 => 'BSH (Berkembang Sesuai Harapan)',
                                                    4 => 'SB (Sangat Berkembang)'
                                                ];
                                                $description = $descriptions[$nilai ? $nilai->nilai : null] ?? '-';
                                            @endphp
                                            {{ $description }}
                                        @elseif($kr->kode_kriteria == 'C5')
                                            @php
                                                $descriptions = [
                                                    4 => 'Tingkat Nasional (Peserta)',
                                                    11 => 'Tingkat Kabupaten/Kota (Juara 1)',
                                                    10 => 'Tingkat Kabupaten/Kota (Juara 2)',
                                                    0 => 'Tidak Ada'
                                                ];
                                                $description = $descriptions[$nilai ? $nilai->nilai : null] ?? '-';
                                            @endphp
                                            {{ $description }}
                                        @else
                                            {{ $nilai ? $nilai->nilai : '-' }}
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Penilaian Alternatif -->
    <div class="card mt-3">
        <div class="card-header">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#penilaianAlternatif" aria-expanded="false" aria-controls="penilaianAlternatif">
                 Penilaian Alternatif
            </button>
        </div>
        <div class="collapse" id="penilaianAlternatif">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            @foreach($kriteria as $k)
                            <th>{{ $k->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->nama_siswa }}</td>
                            @foreach($kriteria as $k)
                            <td>{{ $penilaian->where('siswa_id', $s->id)->where('kriteria_id', $k->id)->first()->nilai }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Normalisasi Matriks -->
    <div class="card mt-3">
        <div class="card-header">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#normalisasiMatriks" aria-expanded="false" aria-controls="normalisasiMatriks">
                 Normalisasi Matriks
            </button>
        </div>
        <div class="collapse" id="normalisasiMatriks">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            @foreach($kriteria as $k)
                            <th>{{ $k->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->nama_siswa }}</td>
                            @foreach($kriteria as $k)
                            <td>{{ number_format($normalisasi[$s->id][$k->id], 9) }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Nilai Penyimpangan -->
    <div class="card mt-3">
        <div class="card-header">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#nilaiPenyimpangan" aria-expanded="false" aria-controls="nilaiPenyimpangan">
                 Nilai Penyimpangan
            </button>
        </div>
        <div class="collapse" id="nilaiPenyimpangan">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            @foreach($kriteria as $k)
                            <th>{{ $k->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nilai Penyimpangan</td>
                            @foreach($nilaiPenyimpangan as $nilai)
                            <td>{{ number_format($nilai, 9) }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bobot Kriteria -->
    <div class="card mt-3">
        <div class="card-header">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#bobotKriteria" aria-expanded="false" aria-controls="bobotKriteria">
                 Bobot Kriteria
            </button>
        </div>
        <div class="collapse" id="bobotKriteria">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            @foreach($kriteria as $k)
                            <th>{{ $k->nama_kriteria }}</th>
                            @endforeach
                            <th>Total Bobot Kriteria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Bobot</td>
                            @foreach($bobotKriteria as $bobot)
                            <td>{{ number_format($bobot, 9) }}</td>
                            @endforeach
                            <td>{{ number_format(array_sum($bobotKriteria), 9) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Perhitungan PSI -->
    <div class="card mt-3">
        <div class="card-header">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#perhitunganPSI" aria-expanded="false" aria-controls="perhitunganPSI">
                 Perhitungan PSI
            </button>
        </div>
        <div class="collapse" id="perhitunganPSI">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Nama Siswa</th>
                            <th>Nilai PSI</th>
                            @foreach($kriteria as $k)
                            <th>{{ $k->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peringkat as $siswa_id => $data)
                        <tr>
                            <td>{{ $data['rank'] }}</td>
                            <td>{{ $data['nama'] }}</td>
                            <td>{{ number_format($data['nilai'], 9) }}</td>
                            @foreach($kriteria as $k)
                                <td>{{ number_format($normalisasi[$siswa_id][$k->id] * $bobotKriteria[$k->id], 9) }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
