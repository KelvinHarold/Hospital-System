<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    // Display the dashboard view with user role counts
    public function index()
    {
        return view('admin.index', [
            'adminCount' => User::role('admin')->count(),
            'doctorCount' => User::role('doctor')->count(),
            'pregnantCount' => User::role('pregnant-woman')->count(),
            'breastfeedingCount' => User::role('breastfeeding-woman')->count(),
            'childCount' => User::role('child')->count(),
        ]);
    }

    // Return user role statistics as JSON for the AJAX chart
    public function getUserStats()
    {
        return response()->json([
            'admin' => User::role('admin')->count(),
            'doctor' => User::role('doctor')->count(),
            'pregnant' => User::role('pregnant-woman')->count(),
            'breastfeeding' => User::role('breastfeeding-woman')->count(),
            'child' => User::role('child')->count(),
        ]);
    }
}