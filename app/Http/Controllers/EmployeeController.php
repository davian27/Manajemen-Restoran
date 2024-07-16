<?php 
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Reservation;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'))->with('i', 0);
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric|min:0',
            'hired_date' => 'required|date|before_or_equal:today',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')
                        ->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric|min:0',
            'hired_date' => 'required|date|before_or_equal:today',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')
                        ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        if (Reservation::where('employee_id', $employee->id)->exists()) {
            return redirect()->route('employees.index')
                             ->with('error', 'Employee cannot be deleted because they are associated with a reservation.');
        }
        $employee->delete();
        return redirect()->route('employees.index')
                        ->with('success', 'Employee deleted successfully.');
    }
}

 ?>