@if ($histori->isEmpty())
<div class="alert alert-danger">
    <p>Tidak ada data</p>
</div>
@else
<ul class="listview image-listview">
    <li>
        <div class="item">
            <div class="in">
                <div>Tanggal</div>
                <div>Jam Datang</div>
                <div>Jam Pulang</div>
            </div>
        </div>
    </li>   
    @foreach ($histori as $d)
    <li>
        <div class="item">
            <div class="in">
                <div>{{ date('d-m-Y', strtotime($d->tgl_presensi))}}</div>
                <span class="badge badge-success">{{ $d->jam_in }}</span>
                <span class="badge badge-danger">{{ $d->jam_out != null ? $d->jam_out : 'Belum' }}</span>
            </div>
        </div>
    </li>                            
    @endforeach
</ul>
@endif