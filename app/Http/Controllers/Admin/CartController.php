<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class CartController extends Controller
{
     public function addtocard(Request $request, $id)
    {

        $product = DB::table('products')->where('id', $id)->first();
        $check = DB::table('carts')->where('product_id', $id)->first();

        if ($check) {
            DB::table('carts')->where('product_id', $id)
                ->increment('product_quantity');

            $product = DB::table('carts')->where('product_id', $id)->first();

            $sub_total = $product->product_quantity * $product->product_price;
            DB::table('carts')->where('product_id', $id)->update(['sub_total' => $sub_total]);

        } else {

            $data = array();
            $data['product_id'] = $id;
            $data['product_name'] = $product->product_name;
            $data['generic_name'] = $product->generic_name;
            $data['unit_power'] = $product->unit_power;
            $data['product_quantity'] = 1;
            $data['product_price'] = $product->best_price;
            $data['sub_total'] = $product->best_price;

            DB::table('carts')->insert($data);

        }

        return response()->json('done');


    }

      public function cartproduct()
    {

        $cart = DB::table('carts')->get();

        return response()->json($cart);

    }

     public function increment($id)
    {


        $quantity = DB::table('carts')->where('id', $id)
            ->increment('product_quantity');

        $product = DB::table('carts')->where('id', $id)->first();

        $sub_total = $product->product_quantity * $product->product_price;
        DB::table('carts')->where('id', $id)->update(['sub_total' => $sub_total]);

        return response('done');

    }


    public function decrement($id)
    {


        $quantity = DB::table('carts')->where('id', $id)
            ->decrement('product_quantity');

        $product = DB::table('carts')->where('id', $id)->first();

        $sub_total = $product->product_quantity * $product->product_price;
        DB::table('carts')->where('id', $id)->update(['sub_total' => $sub_total]);

        return response('done');
    }

    public function removeCart($id)
    {

        DB::table('carts')->where('id', $id)->delete();
        return response('done');

    }
}
