@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Reset Password</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" required value="{{ $email }}">
                        </div>

                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        const password = document.querySelector("#password");
        const passwordConfirm = document.querySelector("#password_confirmation");

        form.addEventListener("submit", function (event) {
            let errors = [];

            if (password.value.length < 8) {
                errors.push("Password harus minimal 8 karakter.");
            }

            if (password.value !== passwordConfirm.value) {
                errors.push("Password dan konfirmasi password tidak cocok.");
            }

            if (errors.length > 0) {
                event.preventDefault();
                alert(errors.join("\n"));
            }
        });
    });
    </script>
@endsection
