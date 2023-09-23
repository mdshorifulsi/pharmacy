<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class DashboardController extends Controller
{
    public function todaysell(){

    $date=Date('d-m-Y');
    $sell=DB::table('orders')->where('order_date',$date)->sum('total');
    return response()->json($sell);

    }

     public function todayincome(){

    $date=Date('d-m-Y');
    $income=DB::table('orders')->where('order_date',$date)->sum('pay');
    return response()->json($income);

    }


    public function todaydue(){

    $date=Date('d-m-Y');
    $due=DB::table('orders')->where('order_date',$date)->sum('due');
    return response()->json($due);

    }

    public function todayexpense(){

    $date=Date('d-m-Y');
    $expense=DB::table('expenses')->where('expense_date',$date)->sum('Amount');
    return response()->json($expense);

    }


    public function stockout(){

    
    $stock=DB::table('products')->where('stock_quantity','<','1')->get();
    return response()->json($stock);

    }


    public function expirydate(){

    $currentDate = date('Y-m-d');
    $stock=DB::table('products')->where('expiry_date', '<=', $currentDate)->get();
    return response()->json($stock);

    }

}
