@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<section class="section dashboard">
    <div class="row">
      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

      <!-- Ucapan Selamat Datang -->
      <div class="col-12">
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">Halo, {{ Auth::user()->name }}!</h4>
          <p>Selamat datang dan selamat melakukan penilaian paralel untuk siswa-siswi MTs NUR IMAN MLANGI.</p>
          <p> Semoga kita mendapatkan hasil yang terbaik.</p>
        </div>
      </div>
      <!-- End Ucapan Selamat Datang -->

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Siswa Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Siswa Aktif <span>| Hari ini</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                     {{ $siswaCount }}
                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Siswa Card -->

          <!-- Kriteria Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Data Kriteria <span>| Hari ini</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-list-check"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                     {{ $kriteriaCount }}
                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Kriteria Card -->

          <!-- Penilaian Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card customers-card customers">
              <div class="card-body">
                <h5 class="card-title">Data Penilaian <span>| Hari ini</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark-check"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                    {{ $penilaianSiswaCount }}
                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Penilaian Card -->

        </div>
      </div>
  </section>
@endsection
