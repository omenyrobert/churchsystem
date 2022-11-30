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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

                    <h3 style="color: #008ad3; ">Members</h3>
                    <a href="{{ url('/members') }}" class="text-decoration-none btn btn-primary">Back</a>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('member.update', $member->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mt-5 p-1">
                            <div class="col-md-6">
                                <div class="m-4">
                                    <label>Full Name</label>
                                    <input type="text" name="full_name" class="form-control mt-2"
                                        placeholder="Full Name" value="{{$member->full_name}}">
                                </div>
                                <div class="m-4">
                                    <label>Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control mt-2"
                                        placeholder="date of birth" value="{{$member->date_of_birth}}">
                                </div>
                                <div class="m-4">
                                    <label>Place of Residence</label>
                                    <input type="text" class="form-control mt-2" name="place_of_residence"
                                        placeholder="Enter Place of Residence" value="{{$member->place_of_residence}}">
                                </div>



                                <div class="m-4">
                                    <label>First Contact</label>
                                    <input type="text" name="contact1" class="form-control mt-2"
                                        placeholder="Enter First Contacts" value="{{$member->contact1}}">
                                </div>

                                <div class="m-4">
                                    <label>Second Contact</label>
                                    <input type="text" name="contact2" class="form-control mt-2"
                                        placeholder="Enter Second Contact" value="{{$member->contact2}}">
                                </div>

                                <div class="m-4">
                                    <label>Photo</label>
                                    <input type="file" class="form-control mt-2" name="photo" placeholder="Photo">
                                </div>
                                <div class="m-4">
                                    <label>Job</label>
                                    <input type="text" class="form-control mt-2" name="job"
                                        placeholder="Job or Occupation" value="{{$member->job}}">
                                </div>

                                <div class="m-4">
                                    <label>Spouse Name</label>
                                    <input type="text" class="form-control mt-2" name="spouse_name"
                                        placeholder="Enter Spouse Name" value="{{$member->spouse_name}}">
                                </div>

                                <div class="m-4">
                                    <label>Spouse Contact</label>
                                    <input type="text" class="form-control mt-2" name="spouse_contact"
                                        placeholder="Enter spouse Contact" value="{{$member->spouse_contact}}">
                                </div>
                                <div class="m-4">
                                    <label>Father's Name</label>
                                    <input type="text" class="form-control mt-2" name="father_name"
                                        placeholder="Enter Father's Name" value="{{$member->fathers_name}}">
                                </div>

                                <div class="m-4">
                                    <label>Father Contact</label>
                                    <input type="text" class="form-control mt-2" name="father_contact"
                                        placeholder="Enter Father's Contact" value="{{$member->fathers_contact}}">
                                </div>

                                <div class="m-4">
                                    <label>Mother's Name</label>
                                    <input type="text" class="form-control mt-2" name="mother_name"
                                        placeholder="Enter Mother's Name" value="{{$member->mothers_name}}">
                                </div>

                                <div class="m-4">
                                    <label>Mother Contact</label>
                                    <input type="text" class="form-control mt-2" name="mother_contact"
                                        placeholder="Enter Mother's Contact" value="{{$member->mothers_contact}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="m-4" id="min-pos">
                                    <label for="ministries">Ministries and Positions</label>
                                    @foreach ($member->ministries as $item)
                                        <div>
                                            <select name="ministry[]" class="form-control mb-1" required id="ministry">
                                                <option value="{{$item->ministry->id}}">{{$item->ministry->ministry}}</option>
                                            </select>
                                            <select name="position[]" class="form-control mb-4" required id="position">
                                                <option value="{{$item->position->id}}">{{$item->position->position}}</option>
                                            </select>
                                        </div>
                                    @endforeach
                                   
                                </div>

                                <div class="d-flex m-4">
                                    <span id="remove-min" class="btn btn-danger text-white my-2"
                                    style="margin-right: 20px;">Remove Ministry</span>
                                    <div>
                                        <span id="add-min" class="btn btn-info text-white my-2"
                                        style="">Add Ministry</span>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary form-control">Update</button>

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

    <script>
        $(document).on('click', '#add-min', function() {
            $.ajax({
                url: "{{ url('/ministry-positions') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var ministries = data.ministries.map(option =>
                        `<option value="${option.id}">${option.ministry}</option>`);
                    var positions = data.positions.map(option =>
                        `<option value="${option.id}">${option.position}</option>`);
                    $('#min-pos').append(
                        '<div>'+
                        '<select name="ministry[]" id="ministry" class="form-control mb-1" required>' +
                        '<option value="" disabled selected>--- Select Ministry ---</option>' +
                        ministries +
                        '</select>' +
                        '<select name="position[]" id="position" class="form-control mb-4" required>' +
                        '<option value="" disabled selected>--- Select Position ---</option>' +
                        positions +
                        '</select>'+
                        '</div>'
                    );
                }
            });
        });
        $(document).on('click','#remove-min',function() {
            $('#min-pos').find('div:last').remove();
        });
    </script>

</body>

</html>
