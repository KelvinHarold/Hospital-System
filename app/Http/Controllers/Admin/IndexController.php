<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class IndexController extends Controller
{
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

    // For AJAX chart data
    public function getUserRoleCounts()
    {
        return response()->json([
            'labels' => ['Admins', 'Doctors', 'Pregnant Women', 'Breastfeeding Women', 'Children'],
            'data' => [
                User::role('admin')->count(),
                User::role('doctor')->count(),
                User::role('pregnant-woman')->count(),
                User::role('breastfeeding-woman')->count(),
                User::role('child')->count(),
            ],
        ]);
    }
}
