@extends('template')

@section('title', 'Home')

@section('content')
<div class="jumbotron p-5 mb-4 bg-light rounded-3 shadow-lg">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h1 class="display-4 fw-bold text-primary">Welcome to RADITH Rumah Sakit</h1>
                <p class="lead text-secondary">
                    Manage doctors' data easily with our comprehensive CRUD application designed for hospital management.
                </p>
                <hr class="my-4">
                <p>Kelola Rmah sakit mu dengan orang orang terpercaya</p>
                <a class="btn btn-primary btn-lg rounded-pill px-4" href="#" role="button">
                    <i class="bi bi-info-circle me-1"></i> Mari Sakit
                </a>
            </div>
            <div class="col-md-5 text-center">
                <img src="{{ asset('images/rumahsakit.jpg') }}"
                alt="Hospital Illustration"
                class="img-fluid rounded-3 shadow-lg"
                style="max-width: 100%; height: auto; object-fit: cover;">
            </div>
        </div>
    </div>
</div>

@endsection
