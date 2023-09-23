<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use DB;

class ExpenseController extends Controller
{
     public function allexpense(){

        $expense=DB::table('expenses')->get();
        return response()->json($expense);
    }

    public function addexpense(Request $request){

        $expense= new Expense;
        $expense->details=$request->details;
        $expense->Amount=$request->Amount;
        $expense->expense_date=date('d-m-Y');
        $expense->save();

    }

    public function deleteexpense($id){

        $expense=Expense::find($id);
        $expense->delete();
    }

    public function editexpense($id){

        $expense=Expense::find($id);
        return response()->json($expense);

    }

    public function updateexpense(Request $request,$id){

      

        $expense=Expense::find($id);
        $expense->details=$request->details;
        $expense->Amount=$request->Amount;
        $expense->expense_date=date('d-m-Y');
        $expense->save();
        

    }
}
