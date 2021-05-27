<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $expense = Expense::paginate($request->total);
        return response()->json($expense);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'details'           => 'required|max:85',
            'amount'            => 'required|max:12'
        ]);

        $expense                = new Expense();
        $expense->details       = $request->details;
        $expense->amount        = $request->amount;
        $expense->date          = date('d-m-y');
        $expense->save();
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
        $validation = $request->validate([
            'details'           => 'required|max:85',
            'amount'            => 'required|max:12'
        ]);

        $expense                = Expense::find($id);
        $expense->details       = $request->details;
        $expense->amount        = $request->amount;
        $expense->date          = date('d-m-y');
        $expense->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();
    }
}
