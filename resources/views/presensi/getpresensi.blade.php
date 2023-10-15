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
@foreach ($presensi as $d)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->sobat_id }}</td>
        <td>{{ $d->nama }}</td>
        <td>{{ $d->nama_kegiatan }}</td>
        <td>{{ $d->posisi }}</td>
        <td>{{ $d->sesi }}</td>
        <td>{{ $d->jam_in }}</td>
        <td>{!! $d->jam_out != null ? $d->jam_out : '<span class="badge bg-danger">Belum presensi</span>' !!}</td>
        <td>
            <a href="#" class="btn btn-primary tampilkanpeta" id="{{ $d->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5"></path>
                    <path d="M9 4v13"></path>
                    <path d="M15 7v5.5"></path>
                    <path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z"></path>
                    <path d="M19 18v.01"></path>
                 </svg>
                 {{ $d->lokasi_in }}  
            </a>
        </td>
        <td>
            @if ($d->jam_in >= '08:00' and $d->sesi == 1)
                @php
                    $jam_terlambat = selisih('08:00:00', $d->jam_in);
                @endphp
                <span class="badge bg-danger">Terlambat {{ $jam_terlambat }}</span>
            @elseif ($d->jam_in >= '15:00' and $d->sesi == 2)
                @php
                    $jam_terlambat = selisih('15:00:00', $d->jam_in);
                @endphp
                <span class="badge bg-danger">Terlambat {{ $jam_terlambat }}</span>
            @else
                <span class="badge bg-success">Tepat waktu</span>
            @endif
        </td>
    </tr>
@endforeach

<script>
    $(function(){
        $(".tampilkanpeta").click(function(e){
            var id = $(this).attr("id");
            $.ajax({
                type:"POST",
                url:'/tampilkanpeta',
                data:{
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                cache: false,
                success: function(respond){
                    $("#loadmap").html(respond);
                }
            });
            $("#modal-tampilkanpeta").modal("show");
        })
    })
</script>