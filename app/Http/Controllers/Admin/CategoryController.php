<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Image;
use File;

class CategoryController extends Controller
{ /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('id', 'DESC')->get();
        return response()->json($category);
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
        $cat_image = $request->cat_image;
        $position = strpos($request->cat_image, ';');
        $sub = substr($request->cat_image, 0, $position);
        $ext = explode('/', $sub)[1];
        $name = time() . '.' . $ext;
        $img = Image::make($request->cat_image)->resize(240, 200);
        $upload_path = "images/category/";
        $images_url = $upload_path . '/' . $name;
        $img->save($images_url);
        $category = new Category;
        $category->cat_name = $request->cat_name;
        $category->cat_slug = Str::slug($category->cat_name);
        $category->cat_image = $images_url;
        $category->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $category=DB::table('categories')->where('id',$id)->first();
        $category = Category::find($id);
        return response()->json($category);
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
        $category = Category::find($id);
        $cat_image = $request->cat_image;
        $position = strpos($request->cat_image, ';');
        $sub = substr($request->cat_image, 0, $position);
        $ext = explode('/', $sub)[1];
        $name = time() . '.' . $ext;
        $img = Image::make($request->cat_image)->resize(240, 200);
        $upload_path = "images/category/";
        $images_url = $upload_path . '/' . $name;
        $img->save($images_url);
        $category->cat_name = $request->cat_name;
        $category->cat_slug = Str::slug($category->cat_name);
        $category->cat_image = $images_url;
        $category->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (File::exists($category->logo)) {
            File::delete($category->logo);
        }
        $category->delete();
        
      
    }
}
