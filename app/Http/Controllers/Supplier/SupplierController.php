<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $supplier = Supplier::paginate($request->total);
        return response()->json($supplier);
    }

    /**
     * Display a listing of the product page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSupplier()
    {
        $getsupplier = Supplier::all();
        return response()->json($getsupplier);
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
            'name'              => 'required',
            'email'             => 'required|unique:suppliers',
            'phone'             => 'required|unique:suppliers',
            'address'           => 'required',
            'city'              => 'required',
            'state'             => 'required',
            'country'           => 'required',
            'shop_name'         => 'required',
            'photo'             => 'required'
        ]);

        $supplier               = new Supplier();
        $supplier->name         = $request->name;
        $supplier->email        = $request->email;
        $supplier->phone        = $request->phone;
        $supplier->address      = $request->address;
        $supplier->city         = $request->city;
        $supplier->state        = $request->state;
        $supplier->country      = $request->country;
        $supplier->shop_name    = $request->shop_name;
        $supplier->photo        = $request->photo;
        $supplier->status       = 1;

        $photo                  = $request->photo;
        if ($photo) {
            $first_position     = strpos($photo, ';');
            $second_position    = substr($photo, 0, $first_position);
            $ext = explode('/', $second_position)[1];
            $photo_name = Str::random(20).time().'.'.$ext;
            Image::make($photo)->resize(500, 400)->save(public_path('uploads/suppliers/' . $photo_name));
            $supplier->photo    = 'uploads/suppliers/'.$photo_name;
        }
        $supplier->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
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
            'email'             => 'required',
            'phone'             => 'required',
            'address'           => 'required',
            'city'              => 'required',
            'state'             => 'required',
            'country'           => 'required',
            'shop_name'         => 'required',
            'photo'             => 'required'
        ]);

        $supplier               = Supplier::find($id);
        $supplier->name         = $request->name;
        $supplier->email        = $request->email;
        $supplier->phone        = $request->phone;
        $supplier->address      = $request->address;
        $supplier->city         = $request->city;
        $supplier->state        = $request->state;
        $supplier->country      = $request->country;
        $supplier->shop_name    = $request->shop_name;
        $supplier->photo        = $request->photo;
        $supplier->status       = 1;

        $photo                  = $request->newphoto;
        $old_photo              = $supplier->photo;
        if ($photo) {
            if ($old_photo) {
                unlink($old_photo);
            }
            $first_position     = strpos($photo, ';');
            $second_position    = substr($photo, 0, $first_position);
            $ext = explode('/', $second_position)[1];
            $photo_name = Str::random(20).time().'.'.$ext;
            Image::make($photo)->resize(500, 400)->save(public_path('uploads/suppliers/' . $photo_name));
            $supplier->photo    = 'uploads/suppliers/'.$photo_name;
        }
        $supplier->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $photo = $supplier->photo;
        if ($photo) {
            unlink($photo);
        }
        $supplier->delete();
    }
}
