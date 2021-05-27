<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salary = Salary::select('salary_month')->groupBy('salary_month')->get();
        return response()->json($salary);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request)
    {
        $employee = Employee::with('get_salary')->paginate($request->total);
        return response()->json($employee);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paid(Request $request)
    {
        $employee = Salary::with('get_employee')->paginate($request->total);
        return response()->json($employee);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewSalary(Request $request, $id)
    {
        $salary = Salary::with('get_employee')->where('salary_month', $id)->paginate($request->total);
        return response()->json($salary);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validation = $request->validate([
            'salary'             => 'required',
            'salarymonth'       => 'required',
        ]);

        $month                   = $request->salarymonth;
        $check = Salary::where('employee_id', $id)->where('salary_month', $month)->first();
        if ($check) {
            $message = 'Salary Already Paid';
            return response()->json($message);
        }
        else {
            $salary                  = new Salary();
            $salary->employee_id     = $id;
            $salary->amount          = $request->salary;
            $salary->salary_date     = date('d-m-y');
            $salary->salary_month    = $month;
            $salary->salary_year     = date('Y');
            $salary->save();
            $message = 'Salary Successfully Paid';
            return response()->json($message);
        }
    }
}
