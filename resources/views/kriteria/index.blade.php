@extends('layouts.app')
@section('title', 'Data Kriteria')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <div class="table-responsive"> <br>
                        <a href="{{ route('kriteria.create') }}" class="text-white btn btn-info bi bi-plus-lg">
                            Tambah Kriteria
                        </a><br><br>
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kriteria as $kriteria)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                        <td>{{ $kriteria->kode_kriteria }}</td>
                                        <td>{{ $kriteria->nama_kriteria }}</td>
                                        <td>{{ $kriteria->jenis_kriteria }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="btn btn-warning bi bi-pencil-square"></a>
                                            
                                            <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger bi bi-trash"></button>
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
