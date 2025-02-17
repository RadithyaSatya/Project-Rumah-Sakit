<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="col-md-4 offset-md-4">
            <h2 class="text-center"><b>Login Aplikasi</b><br>Dashboard</h2>
            <hr>
            @if (session('error'))
                <div class="alert alert-danger">
                    <b>Opps!</b> {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('actionlogin') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Log in</button>
                <hr>
                <p class="text-center">Belum punya akun? <a href="/registrasi">Registrasi</a> sekarang!</p>
            </form>
        </div>
    </div>
</body>
</html>
