<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PosController extends Controller
{

    public function getProduct($id)
    {

        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->select('categories.cat_name', 'brands.brand_name', 'products.*')
            ->where('category_id', $id)
            ->get();
        return response()->json($product);
    }
}
