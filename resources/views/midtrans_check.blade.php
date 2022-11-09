<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Midtrans Check</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 border border-dark">
                <div class="text-center">
                    <h1>Test Akun</h1>
                    <p>*Hanya untuk tester dan tidak dianjurkan untuk melakukan pembayaran dengan kata lain tidak bisa <i>REFUND</i>.</p>
                </div>
                <hr>
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="justify-content-center d-flex">
                    <form method="post" action="{{ url()->current() }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="d-flex">
                                <label for="username" style="width: 100px">Username</label>
                                <input type="text" name="username" id="username" style="outline: none; border:none; border-bottom:1px solid black;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="d-flex">
                                <label for="password" style="width: 100px">Password</label>
                                <input type="password" name="password" id="password" style="outline: none; border:none; border-bottom:1px solid black;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <button id="submit" type="submit" class="btn btn-success ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
</body>
</html>
