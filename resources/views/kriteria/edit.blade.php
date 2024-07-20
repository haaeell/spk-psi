@extends('layouts.app')

@section('title', 'Edit Kriteria')

@section('content')
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Edit Kriteria</h5>
                                    <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3">
                                            <label for="kode_kriteria" class="col-sm-2 col-form-label">Kode</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="kode_kriteria" id="kode_kriteria" value="{{ old('kode_kriteria', $kriteria->kode_kriteria) }}" required />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nama_kriteria" class="col-sm-2 col-form-label">Nama Kriteria</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nama_kriteria" id="nama_kriteria" value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}" required />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="jenis_kriteria" class="col-sm-2 col-form-label">Jenis</label>
                                            <div class="col-sm-10">
                                                <select class="form-select" name="jenis_kriteria" id="jenis_kriteria" required>
                                                    <option value="cost" {{ old('jenis_kriteria', $kriteria->jenis_kriteria) == 'cost' ? 'selected' : '' }}>Cost</option>
                                                    <option value="benefit" {{ old('jenis_kriteria', $kriteria->jenis_kriteria) == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                                </select>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Update Kriteria</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
@endsection
