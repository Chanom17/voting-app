<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/bg.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vote.css') }}">
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

    <div class="container">
        <div class="row bg-red">
            <div class="col-md-12">
                <div class="card-outer p-5 my-3">
                    <h1 class="text-center">ELECTION</h1>
                    <p class="fs-5 text-center mt-3">คลิกที่ปุ่ม <button class="btn btn-success">Vote</button>
                        เพื่อเลือกผู้สมัครที่ต้องการ</p>
                    @if (session('Error'))
                        <div class="alert alert-danger">
                            {{ session('Error') }}
                        </div>
                    @endif
                    <div class="row row-cols-1 row-cols-md-2 g-6">
                        @foreach ($candidates as $candidate)
                            <div class="col">
                                <div class="card mx-auto mb-4" style="width: 27rem;">
                                    <img src="{{ asset('images/' . $candidate->image) }}" class="card-img-top mx-auto"
                                        style="max-width: 27rem; height: 300px; object-fit: cover;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $candidate->name }}</h5>
                                        <p class="card-text">{{ $candidate->party }}</p>
                                        <form
                                            action="{{ route('voter.vote', ['candidate_id' => $candidate->id, 'voter_id' => $voter->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success show_confirm"
                                                name="candidate_id" value="{{ $candidate->id }}">Vote</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                title: "Are you sure ?",
                text: "เมื่อคุณโหวตไปแล้วจะไม่สามารถเปลี่ยนแปลงได้.",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                confirmButtonText: "Yes",
                cancelButtonText: "No"
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
