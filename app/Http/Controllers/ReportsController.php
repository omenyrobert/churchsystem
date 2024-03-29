<?php

namespace App\Http\Controllers;

use App\Models\Incomes;
use App\Models\Expenses;
use App\Models\IncomeTypes;
use App\Models\ExpenseTypes;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income_types = IncomeTypes::all();
        $expense_types = ExpenseTypes::all();
        $incomes = [];
        $expenses = [];
        foreach ($income_types as $income_type) {
            $income = Incomes::where('income_type', $income_type->id)->get();
            $total_income_per_type = Incomes::where('income_type', $income_type->id)->sum('income');
            $income_object = (object) ['incomes_per_type' => $income, 'total' => $total_income_per_type, 'type' => $income_type->income_type];
            $incomes[] = $income_object;
        }
        foreach ($expense_types as $expense_type) {
            $expense = Expenses::where('expense_type', $expense_type->id)->get();
            $total_expense_per_type = Expenses::where('expense_type', $expense_type->id)->sum('expense');
            $expense_object = (object) ['expenses_per_type' => $expense, 'total' => $total_expense_per_type, 'type' => $expense_type->expense_type];
            $expenses[] = $expense_object;
        }
        return view('reports.index', compact('expense_types', 'expenses', 'income_types', 'incomes'));
    }


// print funnction

public function print(Request $request){

    $expenses = json_decode($request->expenses);
    $incomes = json_decode($request->incomes);

    return view('reports.print', compact('expenses','incomes'));


}

    /**
     * Show the filter.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter()
    {
        // dd(request()->all());
        $income_types = IncomeTypes::all();
        $expense_types = ExpenseTypes::all();
        $incomes = [];
        $expenses = [];
        if (!empty(request()->start_date) && !empty(request()->end_date) && !empty(request()->income_type) && !empty(request()->expense_type)) {
            $income_type = IncomeTypes::where('id', request()->income_type)->first();
            $expense_type = ExpenseTypes::where('id', request()->expense_type)->first();
            $start_date = request()->start_date;
            $end_date = request()->end_date;
            $income = Incomes::whereRaw('STR_TO_DATE(date,"%Y-%m-%d") >= STR_TO_DATE("' . $start_date . '","%Y-%m-%d")')
                ->whereRaw('STR_TO_DATE(date,"%Y-%m-%d") <= STR_TO_DATE("' . $end_date . '","%Y-%m-%d")')->where('income_type', $income_type->id)->get();
            $total_income_per_type = Incomes::where('income_type', $income_type->id)->whereRaw('STR_TO_DATE(date,"%Y-%m-%d") >= STR_TO_DATE("' . $start_date . '","%Y-%m-%d")')
                ->whereRaw('STR_TO_DATE(date,"%Y-%m-%d") <= STR_TO_DATE("' . $end_date . '","%Y-%m-%d")')->sum('income');
            $income_object = (object) ['incomes_per_type' => $income, 'total' => $total_income_per_type, 'type' => $income_type->income_type];
            $incomes[] = $income_object;
            $expense = Expenses::whereRaw('STR_TO_DATE(date,"%Y-%m-%d") >= STR_TO_DATE("' . $start_date . '","%Y-%m-%d")')
                ->whereRaw('STR_TO_DATE(date,"%Y-%m-%d") <= STR_TO_DATE("' . $end_date . '","%Y-%m-%d")')->where('expense_type', $expense_type->id)->get();
            $total_expense_per_type = Expenses::where('expense_type', $expense_type->id)->whereRaw('STR_TO_DATE(date,"%Y-%m-%d") >= STR_TO_DATE("' . $start_date . '","%Y-%m-%d")')
                ->whereRaw('STR_TO_DATE(date,"%Y-%m-%d") <= STR_TO_DATE("' . $end_date . '","%Y-%m-%d")')->sum('expense');
            $expense_object = (object) ['expenses_per_type' => $expense, 'total' => $total_expense_per_type, 'type' => $expense_type->expense_type];
            $expenses[] = $expense_object;
            return view('reports.index', compact('expense_types', 'expenses', 'income_types', 'incomes'));
        } else {
            if (!empty(request()->start_date) && empty(request()->end_date)) {
                $start_date = request()->start_date;
                foreach ($income_types as $income_type) {
                    $income = Incomes::where('date', $start_date)->where('income_type', $income_type->id)->get();
                    $total_income_per_type = Incomes::where('income_type', $income_type->id)->where('date', $start_date)->sum('income');
                    $income_object = (object) ['incomes_per_type' => $income, 'total' => $total_income_per_type, 'type' => $income_type->income_type];
                    $incomes[] = $income_object;
                }
                foreach ($expense_types as $expense_type) {
                    $expense = Expenses::where('date', $start_date)->where('expense_type', $expense_type->id)->get();
                    $total_expense_per_type = Expenses::where('date', $start_date)->where('expense_type', $expense_type->id)->sum('expense');
                    $expense_object = (object) ['expenses_per_type' => $expense, 'total' => $total_expense_per_type, 'type' => $expense_type->expense_type];
                    $expenses[] = $expense_object;
                }
            }
            if (empty(request()->start_date) && !empty(request()->end_date)) {
                $end_date = request()->end_date;
                foreach ($income_types as $income_type) {
                    $income = Incomes::where('date', $end_date)->where('income_type', $income_type->id)->get();
                    $total_income_per_type = Incomes::where('income_type', $income_type->id)->where('date', $end_date)->sum('income');
                    $income_object = (object) ['incomes_per_type' => $income, 'total' => $total_income_per_type, 'type' => $income_type->income_type];
                    $incomes[] = $income_object;
                }
                foreach ($expense_types as $expense_type) {
                    $expense = Expenses::where('date', $end_date)->where('expense_type', $expense_type->id)->get();
                    $total_expense_per_type = Expenses::where('date', $end_date)->where('expense_type', $expense_type->id)->sum('expense');
                    $expense_object = (object) ['expenses_per_type' => $expense, 'total' => $total_expense_per_type, 'type' => $expense_type->expense_type];
                    $expenses[] = $expense_object;
                }
            }
            if (!empty(request()->start_date) && !empty(request()->end_date)) {
                $end_date = request()->end_date;
                $start_date = request()->start_date;
                foreach ($income_types as $income_type) {
                    $income = Incomes::whereRaw('STR_TO_DATE(date,"%Y-%m-%d") >= STR_TO_DATE("' . $start_date . '","%Y-%m-%d")')
                        ->whereRaw('STR_TO_DATE(date,"%Y-%m-%d") <= STR_TO_DATE("' . $end_date . '","%Y-%m-%d")')->where('income_type', $income_type->id)->get();
                    $total_income_per_type = Incomes::where('income_type', $income_type->id)->whereRaw('STR_TO_DATE(date,"%Y-%m-%d") >= STR_TO_DATE("' . $start_date . '","%Y-%m-%d")')
                        ->whereRaw('STR_TO_DATE(date,"%Y-%m-%d") <= STR_TO_DATE("' . $end_date . '","%Y-%m-%d")')->sum('income');
                    $income_object = (object) ['incomes_per_type' => $income, 'total' => $total_income_per_type, 'type' => $income_type->income_type];
                    $incomes[] = $income_object;
                }
                foreach ($expense_types as $expense_type) {
                    $expense = Expenses::whereRaw('STR_TO_DATE(date,"%Y-%m-%d") >= STR_TO_DATE("' . $start_date . '","%Y-%m-%d")')
                        ->whereRaw('STR_TO_DATE(date,"%Y-%m-%d") <= STR_TO_DATE("' . $end_date . '","%Y-%m-%d")')->where('expense_type', $expense_type->id)->get();
                    $total_expense_per_type = Expenses::where('expense_type', $expense_type->id)->whereRaw('STR_TO_DATE(date,"%Y-%m-%d") >= STR_TO_DATE("' . $start_date . '","%Y-%m-%d")')
                        ->whereRaw('STR_TO_DATE(date,"%Y-%m-%d") <= STR_TO_DATE("' . $end_date . '","%Y-%m-%d")')->sum('expense');
                    $expense_object = (object) ['expenses_per_type' => $expense, 'total' => $total_expense_per_type, 'type' => $expense_type->expense_type];
                    $expenses[] = $expense_object;
                }
            }
            if (!empty(request()->income_type) && empty(request()->expense_type)) {
                $income_type = IncomeTypes::where('id', request()->income_type)->first();
                $income = Incomes::where('income_type', request()->income_type)->get();
                $total_income_per_type = Incomes::where('income_type', request()->income_type)->sum('income');
                $income_object = (object) ['incomes_per_type' => $income, 'total' => $total_income_per_type, 'type' => $income_type->income_type];
                $incomes[] = $income_object;
            }
            if (!empty(request()->expense_type) && empty(request()->income_type)) {
                $expense_type = ExpenseTypes::where('id', request()->expense_type)->first();
                $expense = Expenses::where('expense_type', request()->expense_type)->get();
                $total_expense_per_type = Expenses::where('expense_type', request()->expense_type)->sum('expense');
                $expense_object = (object) ['expenses_per_type' => $expense, 'total' => $total_expense_per_type, 'type' => $expense_type->expense_type];
                $expenses[] = $expense_object;
            }
            if (!empty(request()->income_type) && !empty(request()->expense_type)) {
                $income_type = IncomeTypes::where('id', request()->income_type)->first();
                $income = Incomes::where('income_type', request()->income_type)->get();
                $total_income_per_type = Incomes::where('income_type', request()->income_type)->sum('income');
                $income_object = (object) ['incomes_per_type' => $income, 'total' => $total_income_per_type, 'type' => $income_type->income_type];
                $incomes[] = $income_object;
                $expense_type = ExpenseTypes::where('id', request()->expense_type)->first();
                $expense = Expenses::where('expense_type', request()->expense_type)->get();
                $total_expense_per_type = Expenses::where('expense_type', request()->expense_type)->sum('expense');
                $expense_object = (object) ['expenses_per_type' => $expense, 'total' => $total_expense_per_type, 'type' => $expense_type->expense_type];
                $expenses[] = $expense_object;

            }
            return view('reports.index', compact('expense_types', 'expenses', 'income_types', 'incomes'));
        }
    }
    // git remote add origin https://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@github.com/omenyrobert/churchsystem.git

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}