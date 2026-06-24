<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Machine;

class MachineController extends Controller
{
    public function index()
    {
        $machines = Machine::all()->where('user_id', Auth::user()->id);
        return view('layouts.machines', compact('machines'));
    }
    public function show(Request $request)
    {
        $search = $request->query('search');

        $machines = Machine::when($search, function ($query, $search) {

            $search = trim($search);

            $query->where(function ($subQuery) use ($search) {
                
                $subQuery->where('name', 'LIKE', "%{$search}%");
            });
        })
        ->where('user_id', Auth::user()->id)->get();

        return view('layouts.machines', compact('machines'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:6'
        ]);
        auth()->user()->machine()->create($validated);
        return redirect()->back();
    }
    public function edit($id) 
    {  
        return response()->json(Machine::select('name')->find($id));
    }
    public function update(Request $request, $id)
    {
        $machines = Machine::find($id);
        $data = $request->only(['name']);
        $machines->update($data);
        return redirect()->back();
    }
    public function delete($id)
    {
        $machines = Machine::find($id);
        $machines->delete();
    }
    
}
