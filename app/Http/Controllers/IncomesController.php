<?php

namespace App\Http\Controllers;

use App\Models\Incomes;
use App\Models\IncomeTypes;
use Illuminate\Http\Request;

class IncomesController extends Controller
{
    public function index(){
        // $income_types = IncomeTypes::all();
        // $incomes = Incomes::all();
        $incomes = [];
        $query_incomes = Incomes::all();
        foreach($query_incomes as $income){
            $type = IncomeTypes::find($income->income_type);
            $income->type = $type;
            $incomes[] = $income;
        }
        $income_types = IncomeTypes::all();
        return view('incomes.index', compact('income_types','incomes'));
    }
    public function store(){
        Incomes::create([
            'date' => request()->date,
            'income_type' => request()->income_type,
            'income' => request()->income,
            'comment' => request()->comment
         ]);
         return redirect()->route('income.index')
         ->with(['success' => 'Income Added successfully.']);
    }

    public function update(Request $request)
    {   
        $request->validate([	
            'income'=> 'required',	
        ]);
        $income = Incomes::find($request->id);
        $income->update([
            'date'=>$request->date,
            'income_type'=>$request->income_type,
            'income' => $request->income,
            'comment'=> $request->comment
        ]);
        return redirect()->route('income.index')
                        ->with(['success' => 'income type Updated successfully.']);
    }

    public function destroy($id)
    {
        $income = Incomes::find($id);
        $income->delete();
        return redirect()->route('income.index')
                        ->with(['success' => 'income Type deleted successfully.']);
        
    }
}