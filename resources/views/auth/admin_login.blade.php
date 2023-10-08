<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top bg-white">
        <div class="container border-bottom">
            <a href="/" class="navbar-brand text-primary fw-bold fs-4">Online Voting</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="dropdown ms-auto me-2">
                <a href="#" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">Login</a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('login') }}" class="dropdown-item">Voter Login</a></li>
                    <li><a href="{{ url('a-login') }}" class="dropdown-item">Admin Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card-body text-center p-5 border border-dark-subtle" style="border-radius: 20px">
                    <h5 class="head-text text-center fs-2">Login for admin</h5>
                    <br>
                    <form action="{{ route('login.admin') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-end">Username :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="username">
                                <span class="text-danger">
                                    @error('username')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label text-end">Password :</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password">
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="offset-sm-5 col-sm-7 d-flex align-items-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <br>
                        @if (Session::has('Fail'))
                            <div class="alert alert-danger">{{ Session::get('Fail') }}</div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
