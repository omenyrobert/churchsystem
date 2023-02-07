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
                        <div class="col-md-6">
                            <h3 style="color: #008ad3; ">Report</h3>
                        </div>
                        <div class="col-md-6"><button class="btn btn-primary"><i
                                    class="bi bi-printer"></i>Print</button></div>

                    </div>
                    <form action="{{route('report.filter')}}" method="POST">
                        @csrf
                        <div class="row mt-4">
                            <div class="col-md-2">
                                <label>Start date</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label>End date</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label>Type Of income</label>
                                <select name="income_type" class="form-control">
                                    <option disabled selected>--- select Income Type ---</option>
                                    @foreach ($income_types as $income_type)
                                        <option value="{{ $income_type->id }}">
                                            {{ $income_type->income_type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Type Of Expense</label>
                                <select name="expense_type" class="form-control">
                                    <option disabled selected>--- select expense Type ---</option>
                                    @foreach ($expense_types as $expense_type)
                                        <option value="{{ $expense_type->id }}">
                                            {{ $expense_type->expense_type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary mt-4">Generate</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">

                        <div class="col-md-6 p-5">
                            <table class="table mt-3">
                                <thead style="background-color: #bbd0d750; color: #008ad3;">
                                    <th class="tab-font">Date</th>
                                    <th class="tab-font">Income Type</th>
                                    <th class="tab-font">Income</th>
                                    <th class="tab-font">Comment</th>

                                </thead>
                                <tbody>
                                    @foreach ($incomes as $income)
                                    @if ($income?->total > 0)
                                    @foreach ($income?->incomes_per_type as $type)
                                    <tr>
                                        <td class="tab-font">{{ $type?->date }}</td>
                                        <td class="tab-font">{{ $income?->type }}</td>
                                        <td class="tab-font">{{ $type?->income }}</td>
                                        <td class="tab-font">{{ $type?->comment }}</td>
                                    </tr>
                                @endforeach
                                <tr class="bg-info">
                                    <td >Sub Total:</td>
                                    <td></td>
                                    <td><b>{{ number_format($income?->total) }}</b></td>
                                    <td></td>
                                </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6 p-5">
                            <table class="table mt-3">
                                <thead style="background-color: #bbd0d750; color: #008ad3;">
                                    <th class="tab-font">Date</th>
                                    <th class="tab-font">Expense Type</th>
                                    <th class="tab-font">Expense</th>
                                    <th class="tab-font">Comment</th>

                                </thead>
                                <tbody>
                                    @foreach ($expenses as $expense)
                                    @if ($expense->total > 0)
                                    @foreach ($expense->expenses_per_type as $type)
                                    <tr>
                                        <td class="tab-font">{{ $type?->date }}</td>
                                        <td class="tab-font">{{ $expense?->type }}</td>
                                        <td class="tab-font">{{ $type?->expense }}</td>
                                        <td class="tab-font">{{ $type?->comment }}</td>
                                    </tr>
                                @endforeach
                                <tr class="bg-info">
                                    <td>Sub Total: </td>
                                    <td></td>
                                    <td><b>{{ number_format($expense->total) }}</b></td>
                                    <td></td>
                                </tr>
                                    @endif  
                                    @endforeach
                                </tbody>
                            </table>
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

</body>

</html>
