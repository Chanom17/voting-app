<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                    <li class="nav-item"><a href="{{ url('all-candidate') }}" class="nav-link">Candidate</a></li>
                    <li class="nav-item"><a href="{{ url('all-voter') }}" class="nav-link">Voter</a></li>
                    <li class="nav-item"><a href="{{ url('result') }}" class="nav-link">Result</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <a href="#" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown">admin</a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('a-logout') }}" class="dropdown-item">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Voters</h3>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Identify ID</th>
                                        <th>Birthday</th>
                                        <th>Voted Check</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($voters as $voter)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $voter->name }}</td>
                                            <td>{{ $voter->identify_id }}</td>
                                            <td>{{ Carbon\Carbon::parse($voter->birthday)->format('Y-m-d') }}</td>
                                            <td>{{ $voter->voted }}</td>
                                            <td><a href="/edit-voter/{{ $voter->id }}"
                                                    class="btn btn-success">Edit</a></td>
                                            <td>
                                                <form action="{{ route('voter.delete', $voter->id) }}" method="POST">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn btn-danger btn-flat show_confirm"
                                                        data-toggle="tooltip" title="Delete">Delete</button>
                                                </form>
                                            </td>
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
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            event.preventDefault();

            var form = $(this).closest("form");

            Swal.fire({
                title: "Are you sure to delete?",
                text: "If you delete this it will be gone forever",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
