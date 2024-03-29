<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }


    public function store(Request $request)
    {
        $employee = Employee::create($request->all());
        return response()->json([
            'status'=>true,
            'message'=>'created employee successfully',
            'data'=>$employee
        ]);
    }


    public function show(Request $request)
    {
        $employee = Employee::findOrFail($request->id);
        return response()->json($employee);
    }



    public function update(Request $request)
    {
        $employee = Employee::findOrFail($request->id);
        if($employee)
        {
            $data['profession_id']  = $request->profession_id ? $request->profession_id : $employee->profession_id;
            $data['hourly_salary']  =$request->hourly_salary ? $request->hourly_salary : $employee->hourly_salary;
            $data['monthly_salary'] =$request->monthly_salary ? $request->monthly_salary : $employee->monthly_salary;
            
            $employee->update($data);
            return response()->json([
                'status'=>true,
                'message' => 'employee Information Updated Successfully',
                'data' => $employee,
            ]);
        }
        else{
            return response()->json([
                'status'=>false,
                'message' => 'employee Information Updated error',
            ]);
        }
    }


    public function destroy(Request $request)
    {
        Employee::find($request->id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'employee Information deleted Successfully',
        ]);
    }
}
