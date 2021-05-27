<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Category::paginate($request->total);
        return response()->json($category);
    }

    /**
     * Display a listing of the product page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategory()
    {
        $api_category = Category::all();
        return response()->json($api_category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name'              => 'required|unique:categories|max:25',
        ]);

        $category               = new Category();
        $category->name         = $request->name;
        $category->slug         = Str::of($request->name)->slug('-');
        $category->save();
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
        $validation = $request->validate([
            'name'              => 'required',
        ]);
        $category               = Category::find($id);
        $category->name         = $request->name;
        $category->slug         = Str::of($request->name)->slug('-');
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
        $category->delete();
    }
}
