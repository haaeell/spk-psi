<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Data Hasil Riwayat</title>
  <style>
    /* Gaya cetak */
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }

    .highlight {
      background-color: #d4edda;
      /* Warna Hijau */
    }

    .card-title {
      text-align: center;
      font-family: Arial, sans-serif;
      font-size: x-large;
    }

    .container {
      font-size: large;
      margin-top: 20px;
    }

    .signature-section {
      position: absolute;
      bottom: 20px;
      right: 20px;
      width: 100%;
      text-align: right;
    }

    .signature {
      display: inline-block;
      text-align: center;
      margin: 0 20px;
    }

    .signature hr {
      border: none;
      border-top: 1px solid #000;
      width: 80%;
      margin: 10px auto;
    }

    @media print {
      .no-print {
        display: none;
      }
    }
  </style>
</head>

<body>
  <section class="section dashboard">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Siswa Berprestasi Paralel MTs Nur Iman Mlangi Tahun {{ $filter_tahun ?? date('Y') }}</h5>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Peringkat</th>
                <th>Kode Siswa</th>
                <th>Nama Siswa</th>
                <th>Nilai Akhir</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($riwayat_perhitungan as $row)
              <tr>
                <td>{{ $row->peringkat }}</td>
                <td>{{ $row->kode_siswa }}</td>
                <td>{{ $row->nama_siswa }}</td>
                <td>{{ number_format($row->nilai_akhir, 9) }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <p>Berdasarkan hasil perhitungan, berikut adalah 3 siswa dengan nilai akhir tertinggi untuk diusulkan menjadi siswa berprestasi paralel tahun {{ $filter_tahun ?? date('Y') }}:</p>
          <ul>
            @foreach ($riwayat_perhitungan->take(3) as $row)
              <li>{{ $row->nama_siswa }}</li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="signature-section">
        <div class="signature">
          <p>Mengetahui,</p>
          <p>Sleman, ......................</p>
        </div>
        <br>
        <br>

        <div class="signature">
          <p>Aminullah M.H.</p>
          <p>Kepala Sekolah</p>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
