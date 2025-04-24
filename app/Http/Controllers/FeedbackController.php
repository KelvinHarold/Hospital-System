<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            $request->validate([
                'appointment_id' => 'required|exists:appointments,id',
                'reply' => 'required|string|max:1000',
                'status' => 'required|in:completed,cancelled', // Ensure status is either completed or cancelled
            ])
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);

        Feedback::create([
            'user_id' => $appointment->user_id,
            'doctor_id' => Auth::id(),
            'message' => $appointment->notes,
            'reply' => $request->reply,
            'status' => $request->status, // Add the status field here
        ]);
        

        return redirect()->back()->with('success', 'Feedback sent successfully.');
    }

    public function index()
    {
        $feedbacks = Feedback::with('doctor')
            ->where('user_id', Auth::id())
            ->whereNotNull('reply') // Ensures only replies are shown
            ->get();
    
        return view('feedback.index', compact('feedbacks'));
    }
    

public function destroy($id)
{
    $feedback = Feedback::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $feedback->delete();
    return redirect()->route('feedback.index')->with('success', 'Feedback deleted successfully.');
}
}

