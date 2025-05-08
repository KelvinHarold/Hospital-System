<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorAppointmentController extends Controller
{
    public function index()
    {
        // Get the logged-in doctor's ID
        $doctorId = Auth::id(); 

        // Retrieve all appointments for this doctor
        $appointments = Appointment::where('doctor_id', $doctorId)->get();

        

        // Pass the appointments to the view
        return view('doctor.Dappointments.index', compact('appointments'));
    }
    public function delete($id)
    {
        $appointment = Appointment::findorFail($id);
        $appointment->delete();
        return view('doctor.Dappointments.index');
    }
}

