@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Siswa</h5>
                    <div class="col-md-3">
                        <a href="{{ asset('template.xlsx') }}" class="btn btn-info  text-white mb-3" download>
                            <i class="fas fa-download"></i> Download Template Excel
                        </a>
                    </div>
                    <div class="col-md-5">
                        <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data" class="mb-3">
                            @csrf
                            <div class="form-group d-flex align-items-center">
                                <input type="file" id="file" name="file" class="form-control mr-2" required>
                                <button type="submit" class="btn btn-info text-white me-2">
                                     Upload
                                </button>
                            </div>
                        </form>
                    </div>
                      <!-- Reset Siswa and Add Siswa Buttons -->
                      <div class="row mb-3 d-flex justify-content-between">
                        <div class="col-md-3">
                            <a href="{{ route('siswa.create') }}" class="btn btn-info text-white">
                                <i class="fas fa-plus"></i> Tambah Siswa
                            </a>
                           </div>

                            <div class="col-md-6">
                                <form action="{{ route('siswa.reset') }}" method="POST" class="me-3">
                                    @csrf
                                    <div class="form-group d-flex align-items-center">
                                        <label for="kelas" class="me-2">Kelas:</label>
                                        <select name="kelas" id="kelas" class="form-control me-2" required>
                                            <option value="">-- Pilih Kelas --</option>
                                            @foreach ($kelasList as $kelas)
                                                <option value="{{ $kelas }}">{{ $kelas }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-danger text-white">
                                            <i class="fas fa-trash"></i> Reset 
                                        </button>
                                    </div>
                                </form>
                            </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Siswa</th>
                                <th scope="col">NISN</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $siswa)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $siswa->kode_siswa }}</td>
                                    <td>{{ $siswa->nisn }}</td>
                                    <td>{{ $siswa->nama_siswa }}</td>
                                    <td>{{ $siswa->kelas }}</td>
                                    <td>{{ $siswa->jenis_kelamin }}</td>
                                    <td>
                                        <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm"><i class='bi bi-pencil'></i></a>
                                        <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class='bi bi-trash'></i></button>
                                        </form>
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
