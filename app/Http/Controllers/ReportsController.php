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
            $income_object = (object)['incomes_per_type' => $income, 'total' => $total_income_per_type, 'type' => $income_type->income_type];
            $incomes[] = $income_object;
        }
        foreach ($expense_types as $expense_type) {
            $expense = Expenses::where('expense_type', $expense_type->id)->get();
            $total_expense_per_type = Expenses::where('expense_type', $income_type->id)->sum('expense');
            $expense_object = (object)['expenses_per_type' => $expense, 'total' => $total_expense_per_type, 'type' => $expense_type->expense_type];
            $expenses[] = $expense_object;
        }
        return view('reports.index', compact('expense_types', 'expenses', 'income_types', 'incomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
