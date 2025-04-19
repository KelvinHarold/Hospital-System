<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\ChildRecord;
use Illuminate\Http\Request;

class DoctorChildRecordController extends Controller
{
    public function create($child_id)
    {
        $child = Child::findOrFail($child_id);
        return view('doctor.children.records.create', compact('child'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'child_id' => 'required|exists:children,id',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'head_circumference' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        ChildRecord::create($validated);

        return redirect()->route('doctor.children.index')->with('success', 'Record added for child.');
    }

    public function show($child_id)
    {
        $child = Child::with(['user', 'records'])->findOrFail($child_id);
    
        return view('doctor.children.records.show', compact('child'));
    }
    

public function edit($id)
{
    $record = ChildRecord::findOrFail($id);
    return view('doctor.children.records.edit', compact('record'));
}

public function update(Request $request, $id)
{
    $record = ChildRecord::findOrFail($id);

    $validated = $request->validate([
        'weight' => 'required|numeric',
        'height' => 'required|numeric',
        'head_circumference' => 'required|numeric',
        'notes' => 'nullable|string',
    ]);

    $record->update($validated);

    return redirect()->route('doctor.children.records.show', $record->child_id)->with('success', 'Record updated successfully.');
}

public function destroy($id)
{
    $record = ChildRecord::findOrFail($id);
    $child_id = $record->child_id;
    $record->delete();

    return redirect()->route('doctor.children.records.show', $child_id)->with('success', 'Record deleted successfully.');
}

}
