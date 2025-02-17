@extends('template')

@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>CRUD RUANGAN</h2>
            </div>
            <div class="float-right">
                <a href="{{ route('ruangan.create') }}" class="btn btn-success">Input Ruangan</a>
            </div>
        </div>
    </div>

    <!-- Form Pencarian -->
    <form action="{{ route('ruangan.index') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari Nama Ruangan" name="search" value="{{ request()->get('search') }}">
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
            <th>Kode Ruangan</th>
            <th class="text-center" width='20%'>Nama Ruangan</th>
            <th class="text-center" width='280px'>Daya Tampung</th>
            <th class="text-center" width='280px'>Lokasi</th>
            <th class="text-center" width='20%'>Action</th>
        </tr>
        @foreach ($ruangan as $ruang)
        <tr>
            <td class="text-center">{{ ++$i }}</td>
            <td>{{ $ruang->kodeRuangan }}</td>
            <td>{{ $ruang->namaRuangan }}</td>
            <td>{{ $ruang->dayaTampung }}</td>
            <td>{{ $ruang->lokasi }}</td>
            <td class="text-center">
                <form action="{{ route('ruangan.destroy', $ruang->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <a href="{{ route('ruangan.show', $ruang->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('ruangan.edit', $ruang->id) }}" class="btn btn-primary btn-sm">Edit</a>

                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $ruangan->links() !!}
@endsection
