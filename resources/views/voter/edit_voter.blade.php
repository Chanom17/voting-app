<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                autoclose: true
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                <a href="#" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown">admin</a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('a-logout') }}" class="dropdown-item">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 ">
                <div class="card-body mx-auto text-end p-5 border border-dark-subtle">
                    <h5 class="head-text text-center fs-2">Edit Voter</h5>
                    <br>
                    <form action="{{ route('voter.update', $voter->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $voter->id }}">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Name :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name" value="{{ $voter->name }}">
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="identify_id" class="col-sm-4 col-form-label">Identify ID :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="identify_id"
                                    value="{{ $voter->identify_id }}">
                                <span class="text-danger">
                                    @error('identify_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="birthday" class="col-sm-4 col-form-label">Birth Day :</label>
                            <div class="col-sm-8 d-flex input-group" style="width: 200px">
                                <input type="text" class="form-control" name="birthday" id="datepicker"
                                    value="{{ Carbon\Carbon::parse($voter->birthday)->format('Y-m-d') }}">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <span class="text-danger">
                                @error('birthday')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="voted" class="col-sm-4 col-form-label">Voted:</label>
                            <div class="col-sm-8">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="voted" value="1"
                                        @if ($voter->voted) checked @endif>
                                </div>
                                <span class="text-danger">
                                    @error('voted')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>


                        <br>
                        <div class="form-group row">
                            <div class="offset-sm-5 col-sm-7 d-flex align-items-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        <br>
                        @if (Session::has('Success'))
                            <div class="alert alert-success text-center">{{ Session::get('Success') }}</div>
                        @endif
                        @if (Session::has('Fail'))
                            <div class="alert alert-danger text-center">{{ Session::get('Fail') }}</div>
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
