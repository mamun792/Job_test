<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    public function index()
    {
        $emplye = Employee::all();
        $employees = Employee::onlyTrashed()->get();

        return view('Emplye.index', compact('emplye', 'employees'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $validation = $request->validate(Employee::$rules);

        try {

            if ($validation) {
                DB::beginTransaction(); // Start a database transaction
                $employee = new Employee();
                $employee->first_name = $request->first_name;
                $employee->last_name = $request->last_name;
                $employee->email = $request->email;
                $employee->phone = $request->phone;
                $employee->designation = $request->designation;
                $employee->salary = $request->salary;
                $employee->company_id = $request->company_id;
                $employee->status = $request->status;

                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $name = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/images');
                    $image->move($destinationPath, $name);
                    $employee->imge = $name;
                }

                $employee->save();
                DB::commit(); // Commit the database transaction
            }

            return back()->with('success', 'Succfully create');
        } catch (\Throwable $th) {

            DB::rollback(); // Rollback the database transaction
            return back()->with('error', 'Something went wrong');
        }
    }



    public function show(string $id)
    {
        $employee = Employee::find($id);
        return view('Emplye.singleEmplye', compact('employee'));
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'designation' => 'required',
            'salary' => 'required',
            'company_id' => 'required',
        ]);

        try {

            DB::beginTransaction(); // Start a database transaction
            $employee = Employee::find($id);

            $employee->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'designation' => $request->designation,
                'salary' => $request->salary,
                'company_id' => $request->company_id,
            ]);

            DB::commit(); // Commit the database transaction

            return back()->with('success', 'Succfully update');
        } catch (\Throwable $th) {
            throw $th;
            return back()->with('error', 'Something went wrong', $th);
        }
    }


    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        $employee->forceDelete();

        return response()->json(['success' => 'Employee deleted successfully']);
    }
    public function softDelete($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
        $employee->delete();

        return response()->json(['success' => 'Employee deleted successfully']);
    }

    public function restore($id)
    {
        $employee = Employee::onlyTrashed()->find($id);
        if ($employee) {
            $employee->restore();
        }
        return back()->with('success', 'Succfully restore');
    }
    public function trash()
    {
        $emplye = Employee::onlyTrashed()->get();
        return view('Emplye.trash', compact('emplye'));
    }
}
