<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class OrderController extends Controller
{
    public function orderdone(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['phone_number'] = $request->phone_number;
        $data['qty'] = $request->qty;
        $data['sub_total'] = $request->subTotal;
        $data['total'] = $request->total;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;
        $data['payby'] = $request->payby;
        $data['order_date'] = date('d-m-Y');
        $data['order_month'] = date('F');
        $data['order_year'] = date('Y');

        $orderId = DB::table('orders')->insertGetId($data);
        $contents = DB::table('carts')->get();

        $odata = array();
        foreach ($contents as $content) {
            $odata['order_id'] = $orderId;
            $odata['product_id'] = $content->product_id;
            $odata['product_quantity'] = $content->product_quantity;
            $odata['product_price'] = $content->product_price;
            $odata['sub_total'] = $content->sub_total;

            DB::table('order_details')->insert($odata);

            DB::table('products')
                ->where('id', $content->product_id)
                ->update(['stock_quantity' => DB::raw('stock_quantity -' . $content->product_quantity)]);

        }
        DB::table('carts')->delete();
        return response('done');
    }

     public function allorder()
    {

        $allorder = DB::table('orders')->orderBy('id', 'DESC')->get();
        return response()->json($allorder);
    }

    public function details($id)
    {

        $order = DB::table('order_details')
            ->join('products', 'order_details.product_id', 'products.id')
            ->join('orders', 'order_details.order_id', 'orders.id')
            ->where('order_details.order_id', $id)
            ->select('products.product_name', 'orders.customer_name', 'orders.phone_number', 'order_details.*')
            ->get();
        return response()->json($order);
    }

    public function order($oid)
    {
        $order = DB::table('orders')
            ->where('orders.id', $oid)
            ->first();
        return response()->json($order);


    }

    public function order_delete($id)
    {
        $order = DB::table('orders')->where('id', $id)->delete();
        return response()->json('done');
    }




    


}
