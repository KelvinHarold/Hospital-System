<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BreastfeedingAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors =User::role('doctor')->get();
        return view('breastfeeding.Bappointments.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'patient_name' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);
        
        Appointment::create([
            'user_id' => Auth::id(), // The patient (logged-in user)
            'doctor_id' => $request->doctor_id, // The doctor selected from the list
            'patient_name' => $request->patient_name,
            'appointment_date' => $request->appointment_date,
            'notes' => $request->notes,
        ]);
        
        return redirect()->back()->with('success', 'Appointment successfully booked.');
    }
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
