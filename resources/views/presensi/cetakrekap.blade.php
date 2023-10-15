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
        font-size: 10px;
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
<body class="A4 landscape">
{{-- @php
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
@endphp --}}


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
            <td colspan="2"><h3>Rekapitulasi Presensi Mitra Pengolahan <br> Periode {{ $namabulan[$bulan] }} {{ $tahun }}</h3></td>
        </tr>
    </table>

    <table class="tabelpresensi">
        <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">Nama</th>
            <th colspan="31">Tanggal</th>
            <th rowspan="2">TH</th>
            <th rowspan="2">TT</th>
        </tr>
        <tr>
            <?php
            for ($i=1; $i <=31 ; $i++) { 
            ?>
            <th>{{ $i }}</th>
            <?php
            }
            ?>
        </tr>
        @foreach ($rekap as $d)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->nama }}</td>
            <?php
            $totalhadir = 0;
            $totalterlambat = 0;
            for ($i=1; $i <=31 ; $i++) {
                $tgl = "tgl_".$i;
                if(empty($d->$tgl)){
                    $hadir = ['',''];
                    $totalhadir +=0;
                } else {
                    $hadir = explode("-",$d->$tgl);
                    $totalhadir +=1;
                    if($hadir[0]>"08:00:00"){
                        $totalterlambat +=1;
                    }
                }
            ?>
            <td><span style="color: {{ $hadir[0]>"08:00:00" ? "red" : "" }}">{{ $hadir[0] }}</span>
                <br>
                <span style="color: {{ $hadir[1]<"12:00:00" ? "red" : "" }}">{{ $hadir[1] }}</span>
            </td>
            <?php
            }
            ?>
            <td>{{ $totalhadir }}</td>
            <td>{{ $totalterlambat }}</td>
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