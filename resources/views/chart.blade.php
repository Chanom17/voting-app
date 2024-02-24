<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candidates Result Chart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/chart.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top bg-white">
        <div class="container border-bottom">
            <a href="/" class="navbar-brand text-primary fw-bold fs-4">Online Voting</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @if (session('loginAdmin'))
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"><a href="{{ url('all-candidate') }}" class="nav-link">Candidate</a></li>
                        <li class="nav-item"><a href="{{ url('all-voter') }}" class="nav-link">Voter</a></li>
                        <li class="nav-item"><a href="{{ url('result') }}" class="nav-link">Result</a></li>
                    </ul>
                </div>
            @endif

            @if (session('loginVoter'))
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown">
                        {{ $voter->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('logout') }}" class="dropdown-item">Logout</a></li>
                    </ul>
                </div>
            @elseif (session('loginAdmin'))
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown">
                        admin
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('a-logout') }}" class="dropdown-item">Logout</a></li>
                    </ul>
                </div>
            @else
                <div class="dropdown ms-auto me-2">
                    <a href="#" class="btn btn-outline-primary dropdown-toggle"
                        data-bs-toggle="dropdown">Login</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('login') }}" class="dropdown-item">Voter Login</a></li>
                        <li><a href="{{ url('a-login') }}" class="dropdown-item">Admin Login</a></li>
                    </ul>
                </div>
                <a href="{{ url('register') }}" class="btn btn-primary">Sign-up</a>
            @endif
        </div>
    </nav>

    <div class="container text-center">
        <div class="card chart-container p-4">
            <h3>ผลการเลือกตั้ง</h3>
            <canvas id="votesChart" style="height: 550px"></canvas>
        </div>
        <br>
        <div class="col-md-6 mx-auto">
            <div class="card p-4">
                <h3>อันดับผู้ที่ได้คะแนนสูงที่สุด</h3>
                <div class="card-body">
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($candidates as $candidate)
                        <div class="border-bottom my-4">
                            <div class="c-image mb-2">
                                <img src="{{ asset('images') }}/{{ $candidate->image }}">
                            </div>
                            <p>{{ $counter }}. {{ $candidate->name }} - Votes: {{ $candidate->votes }}</p>
                            @php
                                $counter++;
                            @endphp
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <br>
        <a href="{{ route('request-pdf') }}" class="btn btn-primary mb-3">Export PDF Result</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var candidates = @json($candidates->pluck('name'));
            var votes = @json($candidates->pluck('votes'));

            var ctx = document.getElementById('votesChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: candidates,
                    datasets: [{
                        label: 'Votes',
                        data: votes,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }
                }
            });
        });
    </script>


</body>

</html>
