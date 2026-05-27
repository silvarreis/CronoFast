<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all()->where('user_id', Auth::user()->id);
        return view('layouts.employee', compact('employees'));
    }
     public function show(Request $request)
    {
        $search = $request->query('search');

        $employees = Employee::when($search, function ($query, $search) {

            $search = trim($search);

            $query->where(function ($subQuery) use ($search) {
                
                $subQuery->where('name', 'LIKE', "%{$search}%");
            });
        })
        ->where('user_id', Auth::user()->id)->get();

        return view('layouts.employee', compact('employees'));
    }
    
    public function store(Request $request)
    {  
        $data = $request->validate([
            'name' => 'required'
        ]);
        auth()->user()->employees()->create($data);
        return redirect()->back();
    }
    public function edit($id) 
    {  
        return response()->json(Employee::select('name', 'active')->find($id));
    }
    public function update(Request $request, $id)
    {
        $employees = Employee::find($id);
        $data = $request->only(['name', 'active']);
        $employees->update($data);
        return redirect()->back();
    }
    public function softDelete($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->active = false;
        $employee->save();
        return response()->json([
            'id' => $employee->id,
            'status' => 'inactive'
        ]);
    }
} 
