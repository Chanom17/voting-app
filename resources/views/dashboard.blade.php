<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bg.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top bg-white">
        <div class="container border-bottom">
            <a href="/" class="navbar-brand text-primary fw-bold fs-4">Online Voting</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="dropdown">
                <a href="#" class="dropdown-toggle text-decoration-none"
                    data-bs-toggle="dropdown">{{ $voter->name }}</a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('logout') }}" class="dropdown-item">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="centainer d-flex align-items-center flex-column text-center" style="height: 686px;">
        <div class="overlay-text">
            <h1 class="text-center mb-3">Online Voting System</h1>
            <a href="{{ url('vote') }}" class="btn btn-primary btn-border">Vote</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
