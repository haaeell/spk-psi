@extends('layouts.app')
@section('content')
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Nilai Siswa</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kriteria as $kr)
                                @php
                                    $nilai = $penilaian->where('kriteria_id', $kr->id)->first();
                                @endphp
                                <tr>
                                    <td>{{ $kr->nama_kriteria }}</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
