<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Image;
use File;
use DB;

class ProductController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   
        $product=Product::with('category','brand')->latest()->get();
        return response()->json($product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_image = $request->product_image;
        $position = strpos($request->product_image, ';');
        $sub = substr($request->product_image, 0, $position);
        $ext = explode('/', $sub)[1];
        $name = time() . '.' . $ext;
        $img = Image::make($request->product_image)->resize(240, 200);
        $upload_path = "images/product/";
        $images_url = $upload_path . '/' . $name;
        $img->save($images_url);

        $product = new Product;
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        $product->product_name=$request->product_name;
        $product->generic_name=$request->generic_name;
        $product->unit_power=$request->unit_power;
        $product->discount=$request->discount;
        $product->buying_price=$request->buying_price;
        $product->mrp=$request->mrp;
        $product->best_price=($request->mrp)-$request->mrp*$request->discount/100;
        $product->manufacture_date=$request->manufacture_date;
        $product->expiry_date=$request->expiry_date;
        $product->stock_quantity=$request->stock_quantity;
        $product->product_image=$images_url;
        $product->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $product = Product::find($id);
        $product_image = $request->product_image;
        $position = strpos($request->product_image, ';');
        $sub = substr($request->product_image, 0, $position);
        $ext = explode('/', $sub)[1];
        $name = time() . '.' . $ext;
        $img = Image::make($request->product_image)->resize(240, 200);
        $upload_path = "images/product/";
        $images_url = $upload_path . '/' . $name;
        $img->save($images_url);
        $product->product_name = $request->product_name;
        $product->generic_name = $request->generic_name;
        $product->unit_power = $request->unit_power;
        $product->discount = $request->discount;
        $product->buying_price = $request->buying_price;
        $product->mrp = $request->mrp;
        $product->manufacture_date = $request->manufacture_dat;
        $product->expiry_date = $request->expiry_date;
        $product->stock_quantity = $request->stock_quantity;
        $product->product_image = $images_url;
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $product = Product::find($id);
        if (File::exists($product->product_image)) {
            File::delete($product->product_image);
        }
        $product->delete();
        
    }
}
