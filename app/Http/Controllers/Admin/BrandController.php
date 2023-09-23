<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;
use Image;
use File;

class BrandController extends Controller
{ /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::orderBy('id', 'DESC')->get();
        return response()->json($brand);
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
        $brand_logo = $request->brand_logo;
        $position = strpos($request->brand_logo, ';');
        $sub = substr($request->brand_logo, 0, $position);
        $ext = explode('/', $sub)[1];
        $name = time() . '.' . $ext;
        $img = Image::make($request->brand_logo)->resize(240, 200);
        $upload_path = "images/brand/";
        $images_url = $upload_path . '/' . $name;
        $img->save($images_url);
        $brand = new Brand;
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = Str::slug($brand->brand_name);
        $brand->brand_logo = $images_url;
        $brand->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::find($id);
        return response()->json($brand);
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
        $brand = Brand::find($id);
        $brand_logo = $request->brand_logo;
        $position = strpos($request->brand_logo, ';');
        $sub = substr($request->brand_logo, 0, $position);
        $ext = explode('/', $sub)[1];
        $name = time() . '.' . $ext;
        $img = Image::make($request->brand_logo)->resize(240, 200);
        $upload_path = "images/brand/";
        $images_url = $upload_path . '/' . $name;
        $img->save($images_url);
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = Str::slug($brand->brand_name);
        $brand->brand_logo = $images_url;
        $brand->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if (File::exists($brand->brand_logo)) {
            File::delete($brand->brand_logo);
        }
        $brand->delete();
        
    }

}
