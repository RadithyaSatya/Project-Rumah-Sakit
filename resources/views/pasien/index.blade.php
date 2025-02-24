@extends('template')

@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>CRUD PASIEN</h2>
            </div>
            <div class="float-right">
                <a href="{{ route('pasien.create') }}" class="btn btn-success">Tambah Pasien</a>
            </div>
        </div>
    </div>

    <!-- Form Pencarian -->
    <form action="{{ route('pasien.index') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari Nama atau Nomor Rekam Medis" name="search" value="{{ request()->get('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th class="text-center">No</th>
            <th>Nomor Rekam Medis</th>
            <th>Nama Pasien</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Kota</th>
            <th>Dokter Penanggung Jawab</th>
            <th class="text-center" width='20%'>Aksi</th>
        </tr>
        @foreach ($pasiens as $pasien)
        <tr>
            <td class="text-center">{{  $loop->iteration }}</td>
            <td>{{ $pasien->nomorRekamMedis }}</td>
            <td>{{ $pasien->namaPasien }}</td>
            <td>{{ \Carbon\Carbon::parse($pasien->tanggalLahir)->format('d-m-Y') }}</td>
            <td>{{ $pasien->jenisKelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
            <td>{{ $pasien->kotaPasien }}</td>
            <td>{{ $pasien->dokter->namaDokter ?? 'Tidak Diketahui' }}</td>
            <td class="text-center">
                <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <a href="{{ route('pasien.show', $pasien->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-primary btn-sm">Edit</a>

                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $pasiens->links() !!}
@endsection
