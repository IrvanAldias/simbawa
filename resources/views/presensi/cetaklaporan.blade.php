<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
    @page { size: A4 }
    body {
        font-family: Arial, Helvetica, sans-serif
    }

    .tabeldatamitra {
        margin-top: 30px;
    }

    .tabeldatamitra td {
        padding: 5px;
    }

    .tabelpresensi {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .tabelpresensi tr th {
        border: 1px solid black;
        padding: 5px;
        background-color: beige;
    }

    .tabelpresensi tr td {
        border: 1px solid black;
        padding: 2px;
        font-size: 12px;
    }

  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
@php
         function selisih($jam_masuk, $jam_keluar)
        {
            list($h, $m, $s) = explode(":", $jam_masuk);
            $dtAwal = mktime($h, $m, $s, "1", "1", "1");
            list($h, $m, $s) = explode(":", $jam_keluar);
            $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = explode(".", $totalmenit / 60);
            $sisamenit = ($totalmenit / 60) - $jam[0];
            $sisamenit2 = $sisamenit * 60;
            $jml_jam = $jam[0];
            return $jml_jam . " jam " . round($sisamenit2) . " menit ";
        }
@endphp


  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <!-- Write HTML just like a web page -->
    <table style="width: 100%">
        <tr>
            <td style="width: 30px">
                <img src="{{ asset('assets/img/login/logobps.svg') }}" width="100">
            </td>
            <td>
                <h3 style="color: rgb(32,107,196)"><i>BADAN PUSAT STATISTIK <br> KABUPATEN SUMBAWA</i></h3>
            </td>
        </tr>
        <tr style="text-align:center">
            <td colspan="2"><h3>Laporan Presensi Mitra Pengolahan <br> Periode {{ $namabulan[$bulan] }} {{ $tahun }}</h3></td>
        </tr>
    </table>

    <table class='tabeldatamitra'>
        <tr>
            <td rowspan="6">
                @php
                    $path = Storage::url('uploads/mitra/'.$mitra->foto);
                @endphp
                <img src="{{ url($path) }}" alt="" width="100px">
            </td>
        </tr>
        <tr>
            <td>Sobat ID</td>
            <td>:</td>
            <td>{{ $mitra->sobat_id }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $mitra->nama }}</td>
        </tr>
        <tr>
            <td>No HP</td>
            <td>:</td>
            <td>{{ $mitra->no_hp }}</td>
        </tr>
        <tr>
            <td>Kegiatan</td>
            <td>:</td>
            <td>{{ $mitra->nama_kegiatan }}</td>
        </tr>
        <tr>
            <td>Posisi</td>
            <td>:</td>
            <td>{{ $mitra->posisi }}</td>
        </tr>
    </table>
    <table class="tabelpresensi">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Total Jam Kerja</th>
        </tr>
        @foreach ($presensi as $d)
        @php
            $jam_terlambat = selisih($d->jam_masuk, $d->jam_in);
        @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</td>
                <td>{{ $d->jam_in }}</td>
                <td>{{ $d->jam_out != null ? $d->jam_out : 'Belum presensi'}}</td>
                <td>{{ $d->lokasi_in }}</td>
                <td>
                    @if ($d->jam_in > $d->jam_masuk)
                        Terlambat {{ $jam_terlambat }}
                    @else
                        Tepat Waktu
                    @endif
                </td>
                <td>
                    @if ($d->jam_out != null)
                        @php
                            $jml_jam_kerja = selisih($d->jam_in,$d->jam_out);
                        @endphp
                    @else
                        @php
                            $jml_jam_kerja = 0;
                        @endphp
                    @endif
                    {{ $jml_jam_kerja }}
                </td>
            </tr>
        @endforeach
    </table>

    <table width='50%' style="margin-top: 30px;" align="right">
        <tr>
            <td style="text-align: center;">Sumbawa, {{ date('d-m-Y') }} </td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align:top">
                <b>Pengawas</b>
                <br>
                <br>
                <br>
                <br>
                <br>
               (.......................................)
            </td>
        </tr>
    </table>
  </section>

</body>

</html>