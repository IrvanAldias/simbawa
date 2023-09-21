@extends('layouts.presensi')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/dashboard" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Edit Profil</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection

@section('content')
<div class="section full mt-2">
    <div class="section-title">Edit Profil</div>
    <div class="wide-block pt-2 pb-2">
        @php
        $messagesuccess = Session::get('success');
        $messageerror = Session::get('error');
        @endphp
        @if(Session::get('success'))
            <div class="alert alert-success">
                {{ $messagesuccess }}
            </div>
        @endif
        @if(Session::get('error'))
            <div class="alert alert-danger">
                {{ $messageerror }}
            </div> 
        @endif
        <div class="card mt-2">
            <form action="/presensi/{{ $mitra->sobat_id }}/updateprofile" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col">
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" value="{{ $mitra->nama }}" name="nama" placeholder="Nama" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" value="{{ $mitra->no_hp }}" name="no_hp" placeholder="No. HP" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                        </div>
                    </div>
                    <div class="custom-file-upload" id="fileUpload1">
                        <input type="file" name="foto" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                        <label for="fileuploadInput">
                            <span>
                                <strong>
                                    <ion-icon name="cloud-upload-outline" role="img" class="md hydrated" aria-label="cloud upload outline"></ion-icon>
                                    <i>Tap to Upload</i>
                                </strong>
                            </span>
                        </label>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <button type="submit" class="btn btn-primary btn-block">
                                <ion-icon name="refresh-outline"></ion-icon>
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>
@endsection