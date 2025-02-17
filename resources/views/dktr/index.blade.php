@extends('template')

@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>CRUD DOKTER</h2>
            </div>
            <div class="float-right">
                <a href="{{ route('dktr.create') }}" class="btn btn-success">Input Dokter</a>
            </div>
        </div>
    </div>

    <!-- Form Pencarian -->
    <form action="{{ route('dktr.index') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari Nama Dokter" name="search" value="{{ request()->get('search') }}">
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
            <th class="text-center" width='20px'>Id</th>
            <th>ID Dokter</th>
            <th class="text-center" width='20%'>Nama Dokter</th>
            <th class="text-center" width='280px'>Tanggal Lahir</th>
            <th class="text-center" width='280px'>Spesialisasi</th>
            <th class="text-center" width='20%'>Action</th>
        </tr>
        @foreach ($dktr as $dokter)
        <tr>
            <td class="text-center">{{ ++$i }}</td>
            <td>{{ $dokter->idDokter }}</td>
            <td>{{ $dokter->namaDokter }}</td>
            <td>{{ $dokter->tanggalLahir }}</td>
            <td>{{ $dokter->spesialisasi }}</td>
            <td class="text-center">
                <form action="{{ route('dktr.destroy', $dokter->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <a href="{{ route('dktr.show', $dokter->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('dktr.edit', $dokter->id) }}" class="btn btn-primary btn-sm">Edit</a>

                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $dktr->links() !!}
@endsection
