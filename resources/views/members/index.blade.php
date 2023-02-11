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
    <div class="container-fluid" style="background-color: #bbd0d750; height: 150vh;">
        @include('layouts.header')
        <div class="d-flex">
            <div class="col-md-2">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-10">
                {{-- @include('layouts.cards') --}}
                <div class="bg-white p-3 mt-2 shadow" style="border-radius: 15px; height: 120vh; overflow-y:auto;">
                    <div class="row">
                        <div class="col-md-4"> <a href="{{ route('member.create') }}" class="text-decoration-none btn btn-primary">Add member</a></div>
                        <div class="col-md-4"><h3 style="color: #008ad3; ">members</h3> </div>
                        <div class="col-md-4">
                            <form action="{{route('member.print')}}" method="POST">
                                @csrf
                                @php
                                    $json_members = json_encode($members);
                                  
                                @endphp
                           
                                <input type="hidden" value="{{ $json_members }}" name="members"/>
                                <button type="submit" class="btn btn-primary"><i
                                    class="bi bi-printer"></i>Print</button>
                            </form>
                        </div>

                    </div>
                          
                        
                         @if ($message = Session::get('success'))
                         <div class="alert alert-success">
                             <p>{{ $message }}</p>
                         </div>
                     @endif
                     <div class="row mt-5">
                        <div class="col-md-4">
                            <p>Filter by Position</p>
                            <form action="{{ route('member.position') }}" method="POST">
                                @csrf
                                <div class="d-flex">
                                    <select class="form-control" name="positionId">
                                        @foreach ($positions as $position )
                                        <option value="{{ $position?->id }}" >
                                            {{$position?->position}}
                                          </option>  
                                        @endforeach
                                    </select>
                                    <button class="btn btn-primary" style="margin-left: 10px;">Filter</button>

                                </div>
                            </form>

                        </div>
                        <div class="col-md-4 pt-4">
                            <input type="search" id="search" class="form-control mt-3" placeholder="Search here.."/>
                        </div>
                        <div class="col-md-4">
                            Filter by Ministry
                            <form action="{{ route('member.ministry') }}" class="mt-3" method="POST">
                                @csrf
                                <div class="d-flex">
                                    <select class="form-control" name="ministryId">
                                        @foreach ($ministries as $ministry )
                                        <option value="{{ $ministry?->id }}">
                                            {{$ministry?->ministry}}
                                          </option>  
                                        @endforeach
                                        
                                      
                                    </select>
                                    <button class="btn btn-primary" style="margin-left: 10px;">Filter</button>

                                </div>
                            </form>
                        </div>

                     </div>
                     <ul class="nav nav-pills mb-3 mt-5" id="pills-tab"  role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Table List</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Grid List</button>
                        </li>
                        
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <table class="table mt-3" id="table">
                                <thead style="background-color: #bbd0d750; color: #008ad3;">
                                  <th>No</th>
                                  <th>Image</th>
                                  <th>Full Name</th>
                                  <th>Place of Residence</th>
                                  <th>Contact</th>
                                  <th>Job</th>
                                  <th>Date Of birth</th>
                                  <th>Ministry</th>
                                  <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($members as $member)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td><img src="{{ !is_null($member->photo) ? asset($member->photo) : asset('upload/user/placeholder.png') }}" style="border-radius: 5px; width: 60px; height: 60px; object-fit: cover;"></td>
                                        <td>{{ $member->full_name }}</td>
                                        <td>{{ $member->place_of_residence }}</td>
                                        <td>{{ $member->contact1 }}</td>
                                                                           
                                        <td>{{ $member?->job }}</td>
                                        <td>{{ $member?->date_of_birth }} - <span class="text-primary">{{ \Carbon\Carbon::parse($member->date_of_birth)->age }} Yrs<span></td>
                                       
                                        <td>
                                            @foreach ($member?->ministries as $position)
                                            <div class="d-flex">{{ $position?->ministry->ministry }} <p style="color: #008ad3; margin-left: 10px;"> {{ $position?->position->position }}</p></div>
                                            @endforeach
                                            </td>
                                       
                                       
                                            <td><div class="d-flex"> <a href="{{ route('member.edit',$member->id) }}"><i class="bi bi-pencil m-1 text-warning"></i> </a>
                                                
                                            <form action="{{ route('member.destroy',$member->id) }}" method="POST"> @csrf<button type="submit" style="margin-top: -5px;" class="btn btn-default"> <i class="bi bi-trash-fill m-1 text-danger"></i></button></form>
                                             <a href="{{ route('member.show',$member->id) }}"> <i class="bi bi-eye-fill m-1 text-primary"></i></a></div></td>
                                       
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>  
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="row">
                            @foreach ($members as $member)
                            <div class="col-md-3">
                                <div class="m-2 shadow rounded-3">
                                    <div class="p-2">
                                <img src="{{ !is_null($member->photo) ? asset($member->photo) : asset('upload/user/placeholder.png') }}" style="border-radius: 15px; width: 100%; height: 270px; object-fit: cover;">
                                    </div>
                                <div class="p-3">
                                <h4 class="text-primary">{{ $member->full_name }}</h4>
                            <div class="d-flex justify-content-between">
                                <div>
                                <p style="font-size: 12px;"><i class="bi bi-geo-alt-fill text-info"></i>&nbsp;{{ $member->place_of_residence }}</p>
                                </div>
                                <div>
                                    <p style="font-size: 12px;"><i class="bi bi-telephone-fill text-info"></i>&nbsp;{{ $member->contact1 }}</p>
                                    </div>
                            </div>

                            <p style="font-size: 12px;"><i class="bi bi-briefcase-fill text-info"></i>&nbsp;{{ $member->job }}</p>
                            </div>
                            </div>
                            </div>
                            @endforeach
                            </div>
                        </div>
                       
                      </div>
                     
                          {{-- {!! $members-links() !!} --}}

                    
                </div>

            </div>

        </div>

    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script>
        $(document).ready(function(){

        // Search all columns
        $('#search').keyup(function(){
            var search = $(this).val();

            $('table tbody tr').hide();

            var len = $('table tbody tr:not(.notfound) td:contains("'+search+'")').length;

            if(len > 0){
              $('table tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
                  $(this).closest('tr').show();
              });
            }else{
              $('.notfound').show();
            }
            
        });
    });
      $.expr[":"].contains = $.expr.createPseudo(function(arg) {
        return function( elem ) {
            return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    });
  </script>

</body>

</html>
