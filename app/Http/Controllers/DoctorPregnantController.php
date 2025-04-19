<?php

namespace App\Http\Controllers;

use App\Models\Pregnant;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorPregnantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pregnants = User::role('pregnant-woman')->get();
        return view('doctor.pregnant.index', compact('pregnants'));
    }

    public function create($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('doctor.pregnant.create', [
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $user_id){
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'pregnancy_week' => 'required|integer',
            'expected_delivery_date' => 'required|date',
            'health_conditions' => 'nullable|string',
        ]);

        Pregnant::create([
            'user_id'=>$user_id,
            'full_name' => $data['full_name'],
            'age' => $data['age'],
            'pregnancy_week' => $data['pregnancy_week'],
            'expected_delivery_date' => $data['expected_delivery_date'],
            'health_conditions' => $data['health_conditions'],
        ]);

        return redirect()->route('doctor.pregnant.index')->with('success', 'Pregnant details added successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        $records = Pregnant::where('user_id', $user_id)->get();
    
        return view('doctor.pregnant.show', compact('user', 'records'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $pregnant = Pregnant::findOrFail($id);
    return view('doctor.pregnant.edit', compact('pregnant'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $pregnant = Pregnant::findOrFail($id);

    $request->validate([
        'full_name' => 'required|string|max:255',
        'age' => 'required|integer|min:1',
        'pregnancy_week' => 'required|integer|min:1|max:42',
        'expected_delivery_date' => 'required|date',
        'health_conditions' => 'nullable|string|max:500',
    ]);

    $pregnant->update([
        'full_name' => $request->full_name,
        'age' => $request->age,
        'pregnancy_week' => $request->pregnancy_week,
        'expected_delivery_date' => $request->expected_delivery_date,
        'health_conditions' => $request->health_conditions,
    ]);

    // ✅ Redirect to show page with the success message
    return redirect()->route('doctor.pregnant.show', $pregnant->user_id)
                     ->with('success', 'Details updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pregnant = Pregnant::findOrFail($id);
        $pregnant->delete();
    
        return redirect()->route('doctor.pregnant.index')
                         ->with('success', 'Pregnant woman record deleted successfully.');
    }
    
}
