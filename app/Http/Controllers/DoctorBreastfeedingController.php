<?php

namespace App\Http\Controllers;

use App\Models\Breastfeeding;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorBreastfeedingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breastfeedings = User::role('breastfeeding-woman')->get();
        return view('doctor.breastfeeding.index', compact('breastfeedings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('doctor.breastfeeding.create', [
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
        
    }

    public function store(Request $request, $user_id)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'breastfeeding_stage' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Breastfeeding::create([
            'user_id' => $user_id,
            'full_name' => $data['full_name'],
            'age' => $data['age'],
            'breastfeeding_stage' => $data['breastfeeding_stage'],
            'notes' => $data['notes'],
        ]);

        return redirect()->route('doctor.breastfeeding.index')->with('success', 'Breastfeeding record added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        $records = Breastfeeding::where('user_id', $user_id)->get();
    
        return view('doctor.breastfeeding.show', compact('user', 'records'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $record = Breastfeeding::findOrFail($id);
        return view('doctor.breastfeeding.edit', compact('record'));
    }
    
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'breastfeeding_stage' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);
    
        $record = Breastfeeding::findOrFail($id);
        $record->update($data);
    
        return redirect()->route('doctor.breastfeeding.show', $record->user_id)->with('success', 'Record updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $record = Breastfeeding::findOrFail($id);
        $record->delete();
    
        return back()->with('success', 'Record deleted successfully.');
    }
    
}
