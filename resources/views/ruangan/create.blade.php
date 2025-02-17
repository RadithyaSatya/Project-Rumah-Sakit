@extends('template')

@section('content')
<div class="row mt-5 mb-5 mx-5">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Tambah Dokter Baru</h2>
        </div>  
        <div class="float-right">
            <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Upsii!!</strong> Input gagal. <br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('ruangan.store') }}" method="POST">
    @csrf
    <div class="row mx-5">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kode Ruangan:</strong>
                <input type="text" name="kodeRuangan" class="form-control" placeholder="KODE RUANGAN">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Ruangan:</strong>
                <input type="text" name="namaRuangan" class="form-control" placeholder="NAMA RUANGAN">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Daya Tampung:</strong>
                <input type="number" name="dayaTampung" class="form-control" placeholder="DAYA TAMPUNG">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lokasi:</strong>
                <input type="text" name="lokasi" class="form-control" placeholder="LOKASI">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">
                Insert
            </button>
        </div>
    </div>
</form>

@endsection
