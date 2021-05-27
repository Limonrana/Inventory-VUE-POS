<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = Product::with(['category', 'supplier'])->paginate($request->total);
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
        $validation = $request->validate([
            'product_name'                  => 'required|unique:products',
            'status'                        => 'required',
            'sub_title'                     => 'required',
            'product_code'                  => 'required',
            'category_id'                   => 'required',
            'selling_price'                 => 'required',
            'product_quantity'              => 'required',
            'photo'                         => 'required',
        ]);

        $product                            = new Product();
        $product->root                      = $request->root;
        $product->brand                     = $request->brand;
        $product->cpu                       = $request->cpu;
        $product->color                     = $request->color;
        $product->ram                       = $request->ram;
        $product->rom                       = $request->rom;
        $product->photo                     = $request->photo;
        $product->status                    = $request->status;
        $product->sub_title                 = $request->sub_title;
        $product->discount                  = $request->discount;
        $product->category_id               = $request->category_id;
        $product->supplier_id               = $request->supplier_id;
        $product->buying_date               = $request->buying_date;
        $product->product_name              = $request->product_name;
        $product->product_code              = $request->product_code;
        $product->display_size              = $request->display_size;
        $product->buying_price              = $request->buying_price;
        $product->selling_price             = $request->selling_price;
        $product->product_quantity          = $request->product_quantity;
        $product->product_description       = $request->product_description;
        $product->slug                      = Str::of($request->product_name)->slug('-');
        $photo                              = $request->photo;
        $product->photo                     = $photo;
        $product->save();

        return "done";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('category', 'supplier')->find($id);
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
        $validation = $request->validate([
            'product_name'                  => 'required',
            'status'                        => 'required',
            'sub_title'                     => 'required',
            'product_code'                  => 'required',
            'category_id'                   => 'required',
            'selling_price'                 => 'required',
            'product_quantity'              => 'required',
        ]);

        $product                            = Product::find($id);
        $product->root                      = $request->root;
        $product->brand                     = $request->brand;
        $product->cpu                       = $request->cpu;
        $product->color                     = $request->color;
        $product->ram                       = $request->ram;
        $product->rom                       = $request->rom;
        $product->photo                     = $request->photo;
        $product->status                    = $request->status;
        $product->sub_title                 = $request->sub_title;
        $product->discount                  = $request->discount;
        $product->category_id               = $request->category_id;
        $product->supplier_id               = $request->supplier_id;
        $product->buying_date               = $request->buying_date;
        $product->product_name              = $request->product_name;
        $product->product_code              = $request->product_code;
        $product->display_size              = $request->display_size;
        $product->buying_price              = $request->buying_price;
        $product->selling_price             = $request->selling_price;
        $product->product_quantity          = $request->product_quantity;
        $product->product_description       = $request->product_description;
        $product->slug                      = Str::of($request->product_name)->slug('-');
        $photo                              = $request->photo;
        $newphoto                           = $request->newphoto;
        if ($newphoto) {
            $product->photo                 = $newphoto;
        }
        else {
            $product->photo                 = $photo;
        }
        $product->save();

        return "done";
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
        $photo = 'uploads/products/'.$product->photo;
        if ($photo) {
            @unlink($photo);
        }
        $product->delete();
    }

    /**
     * Store a newly image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {
        $validation = $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,bmp, webp',
        ]);
        $photo_name = Str::random(20).time().'.'.$request->file->extension();
        Image::make($request->file)->resize(375, 400)->save(public_path('uploads/products/' . $photo_name));
        return $photo_name;
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Request
     * @return \Illuminate\Http\Response
     */
    public function deleteImage(Request $request)
    {
        $filename = $request->imageName;
        $pathname = public_path('uploads/products/'.$filename);
        if (file_exists($pathname)) {
            unlink($pathname);
        }
     }


     //Stock Management All Function start from here

    /**
     * Update the specified resource in Stock Management.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function stockUpdate(Request $request, $id)
    {
        $validation = $request->validate([
            'product_quantity'              => 'required',
        ]);

        $product                            = Product::find($id);
        $product->product_quantity          = $request->product_quantity;
        $product->save();

        return "done";
    }

}
