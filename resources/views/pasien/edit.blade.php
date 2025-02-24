@extends('template')

@section('content')
<div class="row mt-5 mb-5 mx-5">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Edit Data Pasien</h2>
        </div>
        <div class="float-right">
            <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
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

<form action="{{ route('pasien.update', $pasien->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row mx-5">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nomor Rekam Medis:</strong>
                <input type="text" name="nomorRekamMedis" class="form-control" value="{{ $pasien->nomorRekamMedis }}" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Pasien:</strong>
                <input type="text" name="namaPasien" class="form-control" value="{{ $pasien->namaPasien }}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Lahir:</strong>
                <input type="date" name="tanggalLahir" class="form-control" value="{{ $pasien->tanggalLahir }}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jenis Kelamin:</strong>
                <select name="jenisKelamin" class="form-control">
                    <option value="L" {{ $pasien->jenisKelamin == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="P" {{ $pasien->jenisKelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Alamat:</strong>
                <textarea name="alamatPasien" class="form-control">{{ $pasien->alamatPasien }}</textarea>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kota:</strong>
                <input type="text" name="kotaPasien" class="form-control" value="{{ $pasien->kotaPasien }}">
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Penyakit Pasien:</strong>
                <input type="text" name="penyakitPasien" class="form-control" value="{{ $pasien->penyakitPasien }}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Dokter Penanggung Jawab:</strong>
                <select name="idDokter" class="form-control">
                    @foreach ($dokters as $dokter)
                        <option value="{{ $dokter->id }}" {{ $pasien->idDokter == $dokter->id ? 'selected' : '' }}>
                            {{ $dokter->namaDokter }} ({{ $dokter->spesialisasi }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Masuk:</strong>
                <input type="datetime-local" name="tanggalMasuk" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($pasien->tanggalMasuk)) }}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Keluar:</strong>
                <input type="datetime-local" name="tanggalKeluar" class="form-control" value="{{ $pasien->tanggalKeluar ? date('Y-m-d\TH:i', strtotime($pasien->tanggalKeluar)) : '' }}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
@endsection
