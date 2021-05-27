<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employee = Employee::with('get_salary')->paginate($request->total);
        return response()->json($employee);
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
            'name'          => 'required',
            'email'         => 'required|unique:employees',
            'phone'         => 'required|unique:employees',
            'nid'           => 'required',
            'join'          => 'required',
            'salary'        => 'required',
            'photo'         => 'required'
        ]);

        $employee           = new Employee();
        $employee->name     = $request->name;
        $employee->email    = $request->email;
        $employee->phone    = $request->phone;
        $employee->address  = $request->address;
        $employee->nid      = $request->nid;
        $employee->join     = $request->join;
        $employee->salary   = $request->salary;
        $employee->status   = 1;
        $photo              = $request->photo;
        if ($photo) {
            $first_position = strpos($photo, ';');
            $second_position = substr($photo, 0, $first_position);
            $ext = explode('/', $second_position)[1];
            $photo_name = Str::random(20).time().'.'.$ext;
            Image::make($photo)->resize(500, 400)->save(public_path('uploads/employees/' . $photo_name));
            $employee->photo    = 'uploads/employees/'.$photo_name;
        }
        $employee->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
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
            'name'          => 'required',
            'email'         => 'required',
            'phone'         => 'required',
            'nid'           => 'required',
            'join'          => 'required',
            'salary'        => 'required',
            'photo'         => 'required'
        ]);

        $employee = Employee::find($id);
        $employee->name     = $request->name;
        $employee->email    = $request->email;
        $employee->phone    = $request->phone;
        $employee->address  = $request->address;
        $employee->nid      = $request->nid;
        $employee->join     = $request->join;
        $employee->salary   = $request->salary;
        $employee->status   = 1;
        $photo              = $request->newphoto;
        $old_photo          = $employee->photo;
        if ($photo) {
            if ($old_photo) {
                unlink($old_photo);
            }
            $first_position = strpos($photo, ';');
            $second_position = substr($photo, 0, $first_position);
            $ext = explode('/', $second_position)[1];
            $photo_name = Str::random(20).time().'.'.$ext;
            Image::make($photo)->resize(500, 400)->save(public_path('uploads/employees/' . $photo_name));
            $employee->photo    = 'uploads/employees/'.$photo_name;
        }
        $employee->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $photo = $employee->photo;
        if ($photo) {
            unlink($photo);
        }
        $employee->delete();
    }
}
