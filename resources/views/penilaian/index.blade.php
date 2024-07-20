@extends('layouts.app')
@section('title', 'Penilaian')
@section('content')
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Siswa</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                @foreach($kriteria as $kr)
                                    <th>{{ $kr->nama_kriteria }}</th>
                                @endforeach
                                <th>Aksi</th>
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
                                    <td>
                                      <div class="d-flex">
                                        <a href="{{ route('penilaian.edit', $sw->id) }}" class="btn btn-primary"><i class='bi bi-pencil'></i></a>
                                        <a href="{{ route('penilaian.show', $sw->id) }}" class="btn btn-info"><i class='bi bi-eye'></i></a>
                                      </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
