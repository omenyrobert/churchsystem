@php

$all_incomes = \App\Models\Incomes::sum('income');  
                                      
$all_expense = \App\Models\Expenses::sum('expense');  
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
    <title>Church System</title>
    <style>
        .tab-font {
            font-size: 13px;
        }
    </style>
</head>

<body>


                <div class="d-flex" style="width: 100%;">

                    <div class="col-md-6 p-2">
                        <h5 class="text-primary">All Incomes</h5>
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
                                                <td class="tab-font">{{ number_format($type?->income) }}</td>
                                                <td class="tab-font">{{ $type?->comment }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="bg-info">
                                            <td>Sub Total:</td>
                                            <td></td>
                                            <td><b>{{ number_format($income?->total) }}</b></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <td >Total:</td>
                                    <td></td>
                                    <td><h4>{{ number_format($all_incomes) }}</h4></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6 p-2">
                        <h5 class="text-primary">All Expenses</h5>
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
                                                <td class="tab-font">{{ number_format($type?->expense) }}</td>
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
                                <tr>
                                    <td >Total:</td>
                                    <td></td>
                                    <td><h4>{{ number_format($all_expense) }}</h4></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>


    <!-- Optional JavaScript; choose one of the two! -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
<script>
    (function(){
        window.print();
    })();
</script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->

</body>

</html>
