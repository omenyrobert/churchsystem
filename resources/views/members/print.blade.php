<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Church System</title>
</head>

<body>
    <div class="container-fluid bg-white">


        <table class="table mt-3" style="font-size: 13px;">
            <thead style="background-color: #bbd0d750; color: #008ad3;">
                <th>No</th>
                <th>Full Name</th>
                <th>Place of Residence</th>
                <th>Contact</th>
                <th>Parent</th>
                <th>Spouse</th>
                <th>Job</th>
                <th>Date Of birth</th>
               

            </thead>
            <tbody>
                @foreach ($members as $member)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $member->full_name }}</td>
                        <td>{{ $member->place_of_residence }}</td>
                        <td>{{ $member->contact1 }}</td>
                        <td>{{ $member->fathers_name }} {{ $member->Fathers_contact }} <br/> {{ $member->mothers_name }} {{ $member->mothers_contact }}</td>
                        <td>{{ $member?->spouse_name }} {{ $member?->spouse_contact }}</td>
                        <td>{{ $member?->job }}</td>
                        <td>{{ $member?->date_of_birth }} - <span class="text-primary">{{ \Carbon\Carbon::parse($member->date_of_birth)->age }} Yrs<span></td>

                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script>
        (function() {
            window.print();
        })();
    </script>

</body>

</html>
