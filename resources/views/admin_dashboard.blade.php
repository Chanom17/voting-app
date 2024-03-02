<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/bg.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top bg-white">
        <div class="container border-bottom">
            <a href="/" class="navbar-brand text-primary fw-bold fs-4">Online Voting</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a href="/" class="nav-link">Dashboard</a></li>
                    <li class="nav-item"><a href="{{ url('all-candidate') }}" class="nav-link">Candidate</a></li>
                    <li class="nav-item"><a href="{{ url('all-voter') }}" class="nav-link">Voter</a></li>
                    <li class="nav-item"><a href="{{ url('result') }}" class="nav-link">Result</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <a href="#" class="dropdown-toggle text-decoration-none"
                    data-bs-toggle="dropdown">{{ $admin->username }}</a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('a-logout') }}" class="dropdown-item">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="centainer bg-white mx-auto" style="height: 686px; width: 1400px">
        <div class="row">
            <div class="col-md-6 d-flex flex-column align-items-center">
                <div class="card-con d-flex flex-row" style="margin-left: 150px">
                    <div class="card mt-5 me-3">
                        <div class="card-body bg-white p-2 d-inline ">
                            <p class="card-text">จำนวนผู้โหวตทั้งหมด : {{ $voters->count() }} คน</p>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-body bg-white p-2 d-inline ">
                            <p class="card-text">จำนวนแคนดิเดตทั้งหมด : {{ $candidates->count() }} คน</p>
                        </div>
                    </div>
                </div>
                <div class="card chart-card p-2 mt-5" style="margin-left: 150px">
                    <div class="card-header bg-white">
                        <h5>แผนภูมิวงกลมแสดง ผู้ที่โหวตแล้ว/ยังไม่โหวต</h5>
                        <div class="card-body bg-white p-2 mx-auto" style="width: 400px;">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex flex-column align-items-center">
                <div class="voter-lastest card mt-5">
                    <div class="card-header">
                        <h5>ผู้โหวตล่าสุด</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Identify ID</th>
                                    <th scope="col">Voted</th>
                                    <th scope="col">Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestVoters as $voter)
                                    <tr>
                                        <td>{{ $voter->name }}</td>
                                        <td>{{ $voter->identify_id }}</td>
                                        <td>{{ $voter->voted }}</td>
                                        <td>{{ $voter->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="candidates-highest card mt-5" style="margin-right: 75px">
                    <div class="card-header">
                        <h5>ผู้ที่ได้คะแนนสูงสุด Top3</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Party</th>
                                    <th scope="col">votes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($HighestCan as $candidate)
                                    <tr>
                                        <td>{{ $candidate->name }}</td>
                                        <td>{{ $candidate->party }}</td>
                                        <td>{{ $candidate->votes }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('pieChart').getContext('2d');
        var votersCount = {{ $voters->count() }};
        var votedCount = {{ $voters->where('voted', 1)->count() }};
        var notVotedCount = {{ $voters->where('voted', 0)->count() }};

        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['โหวตแล้ว', 'ยังไม่โหวต'],
                datasets: [{
                    data: [votedCount, notVotedCount],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        formatter: function(value, context) {
                            return Math.round(value / votersCount * 100) + '%';
                        }
                    }
                }
            }
        });
    </script>

</body>

</html>
