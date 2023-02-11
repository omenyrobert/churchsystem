<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Church System</title>
</head>

<body>
    <div class="container-fluid" style="background-color: #bbd0d750; height: 120vh;">
        @include('layouts.header')
        <div class="d-flex">
            <div class="col-md-2">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-10">
                {{-- @include('layouts.cards') --}}
                <div class="bg-white p-3 mt-2 shadow overflow-auto" style="border-radius: 15px; height: 100vh;">

                    <h3 style="color: #008ad3; ">members</h3>
                    <a href="{{ url('/members') }}" class="text-decoration-none btn btn-primary">Back</a>
                    <div class="row mt-5 p-1">
                        <div class="col-md-6">
                            <div class="m-4 bg-light rounded p-2 shadow border d-flex">
                                <div style="width: 60%;">
                                    <img src="{{ !is_null($member?->photo) ? asset($member?->photo) : asset('upload/user/placeholder.png') }}"
                                        style="border-radius: 5px; width: 200px; height: 200px; object-fit: cover; border-radius: 100%;">


                                </div>
                                <div>
                                    <h3 style="color: #008ad3; "> {{ $member->full_name }}</h3>
                                    
                                    <p class=""> {{ $member->date_of_birth }} - <span class="text-primary">{{ \Carbon\Carbon::parse($member->date_of_birth)->age }} Yrs<span></p>
                                    <div class="d-flex mt-2">
                                        <p class="text-primary">{{ $member->contact1 }}</p>
                                        <p class="text-primary">&nbsp;{{ $member->contact2 }}</p>
                                    </div>

                                </div>

                            </div>
                            <div class="m-4">

                                @foreach ($member?->ministries as $position)
                                <div class="d-flex">{{ $position?->ministry->ministry }} <p style="color: #008ad3; margin-left: 10px;"> {{ $position?->position->position }}</p></div>
                                @endforeach
                            </div>
                            
                            <div class="m-4">
                                <label>Place of Residence</label><br />
                                <p class="text-primary">{{ $member->place_of_residence }}</p>

                            </div>

                            <div class="m-4">
                                <label>Contract</label><br />
                                <p class="text-primary">{{ $member->date_of_birth }}</p>

                            </div>
                            <div class="m-4">
                                <label>Spouse</label><br />
                                <p class="text-primary"> {{ $member->spouse_name }}</p>
                                <p class="text-primary"> {{ $member->spouse_contact }}</p>
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="m-4">
                                <label>Job</label><br />
                                <p class="text-primary"> {{ $member->job }}</p>
                            </div>

                            <div class="m-4">
                                <label>Father</label><br />
                                <p class="text-primary">{{ $member->fathers_name }}</p>
                                <p class="text-primary">{{ $member->Fathers_contact }}</p>
                            </div>

                            <div class="m-4">
                                <label>Mothers</label><br />
                                <p class="text-primary"> {{ $member->mothers_name }}</p>
                                <p class="text-primary"> {{ $member->mothers_contact }}</p>
                            </div>




                        </div>

                    </div>
                    </form>



                </div>

            </div>

        </div>

    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->

</body>

</html>
