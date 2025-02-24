@extends('template')

@section('content')
<div class="row mt-5 mb-5 mx-5">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Detail Data Pasien</h2>
        </div>
        <div class="float-right">
            <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

<div class="row mx-5">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nomor Rekam Medis:</strong>
            <p>{{ $pasien->nomorRekamMedis }}</p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nama Pasien:</strong>
            <p>{{ $pasien->namaPasien }}</p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tanggal Lahir:</strong>
            <p>{{ date('d-m-Y', strtotime($pasien->tanggalLahir)) }}</p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Jenis Kelamin:</strong>
            <p>{{ $pasien->jenisKelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Alamat:</strong>
            <p>{{ $pasien->alamatPasien }}</p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Kota:</strong>
            <p>{{ $pasien->kotaPasien }}</p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Usia:</strong>
            <p>{{ $pasien->usiaPasien }} tahun</p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Penyakit Pasien:</strong>
            <p>{{ $pasien->penyakitPasien }}</p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Dokter Penanggung Jawab:</strong>
            <p>{{ $pasien->dokter->namaDokter }}</p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tanggal Masuk:</strong>
            <p>{{ date('d-m-Y H:i', strtotime($pasien->tanggalMasuk)) }}</p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tanggal Keluar:</strong>
            <p>
                {{ $pasien->tanggalKeluar ? date('d-m-Y H:i', strtotime($pasien->tanggalKeluar)) : 'Masih dirawat' }}
            </p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nomor Ruangan:</strong>
            <p>{{ $ruangan->kodeRuangan }}</p>
        </div>
    </div>
</div>
@endsection
