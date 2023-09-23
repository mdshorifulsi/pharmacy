<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Image;
use DB;

class StockController extends Controller
{
       public function stock()
    {
   
        $product=Product::with('category','brand')->latest()->get();
        return response()->json($product);

    }

    public function stock_update(Request $request,$id){

         $data=array();
         $data['stock_quantity']=$request->stock_quantity;
         DB::table('products')->where('id',$id)->update($data);

    }
}
