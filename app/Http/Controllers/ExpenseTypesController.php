<?php

namespace App\Http\Controllers;

use App\Models\ExpenseTypes;
use Illuminate\Http\Request;

class ExpenseTypesController extends Controller
{
    public function index(){
        $expense_types = ExpenseTypes::all();
        return view('expenseTypesFolder.index', compact('expense_types'));
    }
    public function store(){
        ExpenseTypes::create([
            'expense_type' => request()->expense_type
         ]);
         return redirect()->route('expense_type.index')
         ->with(['success' => 'Expense Type created successfully.']);
    }

    public function update(Request $request)
    {   
        $request->validate([	
            'expense_type'=> 'required',	
        ]);
       
        $expense_type = ExpenseTypes::find($request->id);
        
        $expense_type->update([
            'expense_type' => $request->expense_type,
        ]);
        return redirect()->route('expense_type.index')
                        ->with(['success' => 'Expense type Updated successfully.']);
    }

    public function destroy($id)
    {
        $expense_type = ExpenseTypes::find($id);
        $expense_type->delete();
        return redirect()->route('expense_type.index')
                        ->with(['success' => 'Expense Type deleted successfully.']);
        
    }
}