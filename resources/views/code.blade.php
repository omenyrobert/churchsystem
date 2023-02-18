<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <title>Church System</title>
</head>

<body>
    @php
        $email = $details->email;
        $token = $details->token;
        $url = 'http://127.0.0.1:8000' . '/password' . '/' . $email . '/' . $token;
    @endphp
    <center>
        <div style="height: 40vh;" class="col-md-5 m-3 p-3 bg-white shadow rounded">
            <div class="bg-primary text-white p-2 rounded">
                <h3 class="text-center">Church System</h3>
                <p class="text-center">Follow the Link below and Change Password</p>
            </div>
            <div class="p-2">
                <p>bgkhhhklrkjpojpejotlggdf</p>
                <p>bgkhhhklrkjpojpejotlggdf</p>
                <p>bgkhhhklrkjpojpejotlggdf</p>
                <p>bgkhhhklrkjpojpejotlggdf</p>

                <a href="{{ $url }}"><button class="btn btn-primary">Click To Resset
                        Password</button></a>
            </div>

        </div>
    </center>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
