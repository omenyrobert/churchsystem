<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> -->
    <title>Church System</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-md-7" style="background-image: url('https://res.cloudinary.com/dtlkiv19d/image/upload/v1667468485/ada2_hvetzs.jpg'); border-top-right: 25%; border-bottom-right: 25%; background-size: 100%;"> --}}

            <div class="col-md-7"
                style="background-image: url('https://res.cloudinary.com/dtlkiv19d/image/upload/v1667473496/aas_dptbfp.jpg'); background-size: cover;">


            </div>
            <div style="height: 100vh;" class="col-md-5 my-3 p-5">
                <br /><br /><br />
                <div>
                    <a href="/" class="btn btn-primary">Back</a>
                </div>
                <h1 class="text-center text-primary"><b>Church System</b></h1>
                <h5 class="text-center text-info"><b>Manage Your church The Best Way</b></h5>
                <br />
                <div class="bg-white shadow rounded-3 m-5 p-5">
                    <div style="margin-left: 10px; text-align: center;">
                        <h4 class="text-primary">Enter Your Email</h4>

                    </div>
                    <br />
                    <form class="p-3" method="POST" action="{{ route('login') }}">
                        @csrf
                        <label>Email</label>
                        <br />
                        <input type="email" class="form-control" placeholder="Enter Email" name="email">
                        <br />

                        <button type="submit" class="form-control btn btn-primary">Resset Password</button>

                    </form>
                </div>
            </div>



        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> -->
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
