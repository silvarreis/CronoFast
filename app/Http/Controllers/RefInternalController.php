<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\InternalReference;


class RefInternalController extends Controller
{
    public function index()
    {
        $refIternals = InternalReference::all()->where('user_id', Auth::user()->id);
        return view('layouts.ref-internal', compact('refIternals'));
    }
    public function show(Request $request)
    {
        $search = $request->query('search');

        $refIternals = InternalReference::when($search, function ($query, $search) {
            $query->where('ref_code', 'LIKE', "%{$search}%");
        })->where('user_id', Auth::user()->id)->get();

        return view('layouts.ref-internal', compact('refIternals'));
    }
    public function store(Request $request)
    {  
        $validated = $request->validate([
            'ref_code' => 'required|max:20',
        ]);
        $validated['ref_code'] = Str::upper($validated['ref_code']);
        auth()->user()->refInternal()->create($validated);
        return redirect()->back();
    }
     public function edit($id) 
    {  
        return response()->json(InternalReference::select('ref_code')->find($id));
    }
    public function update(Request $request, $id)
    {
        $refIternals = InternalReference::find($id);
        $data = $request->only(['ref_code']);
        $refIternals->update($data);
        return redirect()->back();
    }
    public function delete($id)
    {
        $refIternals = InternalReference::find($id);
        $refIternals->delete();
        return redirect()->back();
    }
}
