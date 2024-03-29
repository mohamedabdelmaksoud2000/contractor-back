<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        return response()->json($expenses);
    }

    public function show($id)
    {
        $expense = Expense::find($id);
        return response()->json($expense);
    }

    public function store(Request $request)
    {
        $expense = Expense::create($request->all());
        return response()->json($expense);
    }

    public function update(Request $request,$id)
    {
        $expense = Expense::find($id);
        if($expense)
        {
            $data['title'] = $request->title ? $request->title : $expense->title;
            $data['describe'] = $request->describe ? $request->typdescribee : $expense->describe ;
            $data['date'] = $request->date ? $request->date : $expense->date ;
            // $data['total'] = $request->total ? $request->total : $expense->total ;
            $data['client_id'] = $request->client_id ?$request->client_id : $expense->client_id ;

            $expense->update($data);
            return response()->json($expense);
        }
    }

    public function destroy($id)
    {
        Expense::find($id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Expense Information deleted Successfully',
        ]);
    }
}
