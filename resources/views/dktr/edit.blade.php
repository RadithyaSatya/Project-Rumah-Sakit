@extends('template')

@section('content')
<div class="row mt-5 mb-5 mx-5">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Edit Dokter</h2>
        </div>
        <div class="float-right">
            <a href="{{ route('dktr.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Upsii!!</strong> Input gagal. <br><br>
        <ul>
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('dktr.update', $dktr->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row mx-5">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID Dokter:</strong>
                <input type="text" name="idDokter" class="form-control" placeholder="ID DOKTER" value="{{ $dktr->idDokter }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Dokter:</strong>
                <input type="text" name="namaDokter" class="form-control" placeholder="NAMA DOKTER" value="{{ $dktr->namaDokter }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Lahir:</strong>
                <input type="date" name="tanggalLahir" class="form-control" placeholder="Tanggal Lahir" value="{{ $dktr->tanggalLahir }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Spesialisasi:</strong>
                <select name="spesialisasi" class="form-control">
                    <option value="{{ $dktr->spesialisasi }}"> {{ $dktr->spesialisasi }} </option>
                    <option value="Poli Umum">Poli Umum</option>
                    <option value="Poli Anak">Poli Anak</option>
                    <option value="Poli Gigi">Poli Gigi</option>
                    <option value="Poli Mata">Poli Mata</option>
                    <option value="Poli Kulit">Poli Kulit</option>
                    <option value="Poli Penyakit Dalam">Poli Penyakit Dalam</option>
                    <option value="Poli Konseling">Poli Konseling</option>
                    <option value="Poli Saraf">Poli Saraf</option>
                    <option value="Poli THT">Poli THT</option>
                    <option value="Poli Bedah">Poli Bedah</option>
                    <option value="Poli Paru">Poli Paru</option>
                    <option value="Poli Jantung">Poli Jantung</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lokasi Praktik:</strong>
                <select name="lokasiPraktik" class="form-control">
                    <option value="{{ $dktr->lokasiPraktik }}"> {{ $dktr->lokasiPraktik }} </option>
                    <option value="Jatiwaringin">Jatiwaringin</option>
                    <option value="Cipayung">Cipayung</option>
                    <option value="Cilangkap">Cilangkap</option>
                    <option value="Munjul">Munjul</option>
                    <option value="Cibubur">Cibubur</option>
                    <option value="Jatinegara">Jatinegara</option>
                    <option value="Matraman">Matraman</option>
                    <option value="Kebon Jeruk">Kebon Jeruk</option>
                    <option value="Tangerang">Tangerang</option>
                    <option value="Depok">Depok</option>
                    <option value="Bekasi">Bekasi</option>
                    <option value="Tambun">Tambun</option>
                    <option value="Cikarang">Cikarang</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jam Praktik:</strong>
                <input type="time" class="form-control" name="jamPraktik" value="{{ $dktr->jamPraktik }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </div>
    </div>
</form>
@endsection

