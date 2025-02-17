@extends('template')

@section('title', 'Profile')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-3">
                <div class="card-body text-center">
                    <h2 class="fw-bold text-primary">User Profile</h2>
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{ Auth::user()->path_poto ? asset(Auth::user()->path_poto) : asset('images/defaultpp.jpg') }}"
                             alt="Profile Picture"
                             class="img-fluid rounded-circle shadow-sm mb-3"
                             style="width: 150px; height: 150px; object-fit: cover;">
                        <a href="{{ route('profile.photo') }}" class="btn btn-primary mt-2">
                            <i class="bi bi-pencil"></i> Edit Photo
                        </a>
                    </div>
                    <ul class="list-group list-group-flush text-start">
                        <li class="list-group-item"><strong>Name:</strong> {{ Auth::user()->name }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ Auth::user()->email }}</li>
                        <li class="list-group-item"><strong>Address:</strong> {{ Auth::user()->alamat }}</li>
                        <li class="list-group-item"><strong>Joined At:</strong> {{ Auth::user()->created_at->format('d M Y') }}</li>
                    </ul>
                    <form action="{{ route('profile.update') }}" method="POST" class="mt-3 text-start">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Address</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ Auth::user()->alamat }}">
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
