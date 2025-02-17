@extends('template')

@section('content')
<div class="row mt-5 mb-5 mx-5">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Detail Ruangan</h2>
        </div>
        <div class="float-right">
            <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

<div class="row mx-5">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Kode Ruangan:</strong>
            <p>{{ $ruangan->kodeRuangan }}</p>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nama Ruangan:</strong>
            <p>{{ $ruangan->namaRuangan }}</p>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Daya Tampung:</strong>
            <p>{{ $ruangan->dayaTampung }}</p>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Lokasi:</strong>
            <p>{{ $ruangan->lokasi }}</p>
        </div>
    </div>
</div>

@endsection
