<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Operation;

class OperationController extends Controller
{
    public function index()
    {
        $operations = Operation::all()->where('user_id', Auth::user()->id);
        return view('layouts.operation', compact('operations'));
    }
    public function show(Request $request)
    {
        $search = $request->query('search');

        $operations = Operation::when($search, function ($query, $search) {
            $query->where('description', 'LIKE', "%{$search}%");
        })->where('user_id', Auth::user()->id)->get();

        return view('layouts.operation', compact('operations'));
    }
    public function store(Request $request)
    {  
        $validated = $request->validate([
            'description' => 'required|max:255',
        ]);
        auth()->user()->operation()->create($validated);
        return redirect()->back();
    }
    public function edit($id) 
    {  
        return response()->json(Operation::select('description')->find($id));
    }
    public function update(Request $request, $id)
    {
        $operations = Operation::find($id);
        $data = $request->only(['description']);
        $operations->update($data);
        return redirect()->back();
    }
    public function softDelete($id)
    {
        $operations = Operation::find($id);
        $operations->delete();
    }
}
