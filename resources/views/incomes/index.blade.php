
@php

$all_incomes = \App\Models\Incomes::sum('income');  
                                      

@endphp
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
    <style>
        .tab-font {
            font-size: 13px;
        }
    </style>
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
                <div class="bg-white p-3 mt-2 shadow overflow-auto" style="border-radius: 15px; height: 80vh;">
                    <div class="d-flex" style="justify-content: space-between">
                        <h3 style="color: #008ad3; ">Incomes</h3>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your
                            input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-5 p-5">
                                    <form action="{{ route('income.store') }}" method="POST">
                                        @csrf
                                        <label>Date</label>
                                        <input type="date" name="date" class="form-control">
                                        <br/>
                                        <label>Income Type</label>
                                        <select name="income_type" class="form-control">
                                        <option disabled>--- select Income Type ---</option>
                                        @foreach($income_types as $income_type)
                                        <option value="{{$income_type->id}}">
                                            {{$income_type->income_type}}
                                        </option>
                                        @endforeach
                                         </select>
                                         <br/>
                                         <label>Income</label>
                                         <input type="number" name="income" placeholder="Income amount" class="form-control">
                                         <br/>
                                         <label>Comment</label>
                                         <input type="text" name="comment" placeholder="Comment for Income " class="form-control">
                                         <br/>
                                        <button type="submit" class="btn btn-primary mt-4 w-100">Add</button>
                                    </form>

                                </div>
                                <div class="col-md-7 p-5">
                                    <input type="search" id="search" class="form-control" placeholder="Search here.."/>
                                    <table class="table mt-3" id="table">
                                        <thead style="background-color: #bbd0d750; color: #008ad3;">
                                            <th class="tab-font">Date</th>
                                            <th class="tab-font">Income Type</th>
                                            <th class="tab-font">Income</th>
                                            <th class="tab-font">Comment</th>
                                            <th class="tab-font">Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($incomes as $income )
                                                <tr>
                                                    <td class="tab-font">{{ $income->date }}</td>
                                                    <td class="tab-font">{{ $income?->type?->income_type }}</td>
                                                    <td class="tab-font">{{ number_format($income->income) }}</td>
                                                    <td class="tab-font">{{ $income->comment }}</td>
                                                    <td class="tab-font"><div class="d-flex"> <i class="bi bi-pencil m-1 text-warning cursor-pointer" role="button" data-bs-toggle="modal" data-bs-target="#edit{{ $income->id }}"></i><i class="bi bi-trash m-1 text-danger cursor-pointer" role="button" data-bs-toggle="modal" data-bs-target="#del{{ $income->id }}"></i>
                                                        
                                                         </div>
                                                         {{-- edit modal start --}}
                                                         <div class="modal fade" id="edit{{ $income->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                <div class="modal-header bg-primary">
                                                                  <h5 class="modal-title text-white" id="exampleModalLabel">Update Income</h5>
                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="{{ route('income.update') }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                            
                                                                <div class="modal-body">
                                                                  <input type="hidden" value="{{ $income->id }}" name="id">
                                                                  <labe>Date</labe>
                                                                  <input type="date" value="{{ $income->date }}" class="form-control"  name="date">
                                                                  <br/>
                                                                  <labe>Income Type</labe>
                                                                  <select name="income_type" value="{{ $income->income_type }}" class="form-control">
                                                                      <option disabled>--- select Income Type ---</option>
                                                                          @foreach($income_types as $income_type)
                                                                            <option value="{{$income_type->id}}">
                                                                              {{$income_type->income_type}}
                                                                             </option>
                                                                             @endforeach
                                                                  </select>
                                                                   <br/>
                                                                   <labe>Income</labe>
                                                                  <input type="number" value="{{ $income->income }}" class="form-control"  name="income">
                                                                  <br/>
                                                                  <labe>Comment</labe>
                                                                  <input type="text" value="{{ $income->comment }}" class="form-control"  name="comment">
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                  <button type="submit" class="btn btn-primary">Update</button>
                                                                </div>
                                                                </form>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          {{-- edit modal end --}}


                                                          {{-- delete modal start --}}
                                                         <div class="modal fade" id="del{{ $income->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                <div class="modal-header bg-primary">
                                                                  <h5 class="modal-title text-white" id="exampleModalLabel">Delete Income ?</h5>
                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="{{ route('income.destroy',$income->id) }}" method="POST">
                                                                @csrf                                                                <div class="modal-body">
                                                                  <input type="hidden" value="{{ $income->id }}" name="id">
                                                                  
                                                                  <h4 class="text-primary">{{ $income->income }} </h4>
                                                                  <h6>{{ $income->income_type }} </h6>
                                                                  <h6>{{ $income->comment }} </h6>
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                  <button type="submit" class="btn btn-danger">Confirm</button>
                                                                </div>
                                                                </form>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          {{-- delete modal end --}}
                                                        
                                                        </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tr>
                                            <td colspan="2"><h5 class="text-primary"> Total</h5></td><td class="tab-font"><h5 class="text-primary">{{ number_format($all_incomes) }}</h5></td>
                                        </tr>
                                    </table>
                                </div>

                            </div>

                            
                              
                           

                        </div>
                        
                    </div>

                </div>

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
