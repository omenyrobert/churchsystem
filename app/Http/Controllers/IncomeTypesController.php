<?php

namespace App\Http\Controllers;

use App\Models\IncomeTypes;
use Illuminate\Http\Request;

class IncomeTypesController extends Controller
{
    public function index()
    {
        $income_types = IncomeTypes::all();
        return view('incomeTypesFolder.index', compact('income_types'));
    }
    public function store()
    {
        IncomeTypes::create([
            'income_type' => request()->income_type
        ]);
        return redirect()->route('income_type.index')
            ->with(['success' => 'Income Type created successfully.']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'income_type' => 'required',
        ]);
        $income_type = IncomeTypes::find($request->id);
        $income_type->update([
            'income_type' => $request->income_type,
        ]);
        return redirect()->route('income_type.index')
            ->with(['success' => 'Expense type Updated successfully.']);
    }

    public function destroy($id)
    {
        $income_type = IncomeTypes::find($id);
        $income_type->delete();
        return redirect()->route('income_type.index')
            ->with(['success' => 'Expense Type deleted successfully.']);
    }
}
