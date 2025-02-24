@extends('template')

@section('content')
<div class="row mt-5 mb-5 mx-5">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Tambah Pasien Baru</h2>
        </div>
        <div class="float-right">
            <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Oops!</strong> Terjadi kesalahan pada input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('pasien.store') }}" method="POST">
    @csrf
    <div class="row mx-5">
        <div class="col-md-6">
            <div class="form-group">
                <strong>Nomor Rekam Medis:</strong>
                <input type="text" name="nomorRekamMedis" class="form-control" placeholder="Masukkan Nomor Rekam Medis">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>Nama Pasien:</strong>
                <input type="text" name="namaPasien" class="form-control" placeholder="Masukkan Nama Pasien">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>Tanggal Lahir:</strong>
                <input type="date" name="tanggalLahir" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>Jenis Kelamin:</strong>
                <select name="jenisKelamin" class="form-control">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Alamat:</strong>
                <textarea name="alamatPasien" class="form-control" rows="3" placeholder="Masukkan Alamat"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>Kota:</strong>
                <input type="text" name="kotaPasien" class="form-control" placeholder="Masukkan Kota">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>Penyakit:</strong>
                <input type="text" name="penyakitPasien" class="form-control" placeholder="Masukkan Penyakit (Opsional)">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>Dokter Penanggung Jawab:</strong>
                <select name="idDokter" class="form-control">
                    <option value="">Pilih Dokter</option>
                    @foreach ($dokters as $dokter)
                        <option value="{{ $dokter->id }}">{{ $dokter->namaDokter }} - {{ $dokter->spesialisasi }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>Tanggal Masuk:</strong>
                <input type="datetime-local" name="tanggalMasuk" class="form-control">
            </div>
        </div>
        {{-- <div class="col-md-6">
            <div class="form-group">
                <strong>Tanggal Keluar:</strong>
                <input type="datetime-local" name="tanggalKeluar" class="form-control">
            </div>
        </div> --}}
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>

@endsection
