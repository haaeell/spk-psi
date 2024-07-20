@extends('layouts.app')
@section('title', 'Edit Penilaian')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Penilaian - {{ $siswa->nama_siswa }}</h5>
                        <form action="{{ route('penilaian.createOrUpdate') }}" method="POST">
                            @csrf
                            <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                            @foreach ($kriteria as $kr)
                                @php
                                    $nilai = $penilaian->where('kriteria_id', $kr->id)->first();
                                    $nilaiValue = $nilai ? $nilai->nilai : null;
                                @endphp
                                <div class="mb-3">
                                    <label for="kriteria_{{ $kr->id }}"
                                        class="form-label">{{ $kr->nama_kriteria }}</label>
                                    @if (in_array($kr->kode_kriteria, ['C2', 'C3']))
                                        <select name="kriteria[{{ $kr->id }}][nilai]" class="form-control"
                                            id="kriteria_{{ $kr->id }}" required>
                                            <option value="1" {{ $nilaiValue == 1 ? 'selected' : '' }}>MB (Mulai
                                                Berkembang)</option>
                                            <option value="2" {{ $nilaiValue == 2 ? 'selected' : '' }}>B (Berkembang)
                                            </option>
                                            <option value="3" {{ $nilaiValue == 3 ? 'selected' : '' }}>BSH (Berkembang
                                                Sesuai Harapan)</option>
                                            <option value="4" {{ $nilaiValue == 4 ? 'selected' : '' }}>SB (Sangat
                                                Berkembang)</option>
                                        </select>
                                    @elseif(in_array($kr->kode_kriteria, ['C5']))
                                        <select name="kriteria[{{ $kr->id }}][nilai]" class="form-control"
                                            id="kriteria_{{ $kr->id }}" required>
                                            <option value="4" {{ $nilaiValue == 4 ? 'selected' : '' }}>Tingkat
                                                Nasional (Peserta)</option>
                                            <option value="11" {{ $nilaiValue == 11 ? 'selected' : '' }}>Tingkat
                                                Kabupaten/Kota (Juara 1)</option>
                                            <option value="10" {{ $nilaiValue == 10 ? 'selected' : '' }}>Tingkat
                                                Kabupaten/Kota (Juara 2)</option>
                                            <option value="0" {{ $nilaiValue == 0 ? 'selected' : '' }}> Tidak Ada
                                            </option>
                                        </select>
                                    @else
                                        <input type="number" name="kriteria[{{ $kr->id }}][nilai]"
                                            class="form-control" id="kriteria_{{ $kr->id }}"
                                            value="{{ $nilaiValue }}" required>
                                    @endif
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-info">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
