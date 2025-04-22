<?php

namespace App\Http\Controllers;

use App\Models\Breastfeeding;
use App\Models\Child;
use App\Models\Organisation;
use App\Models\Pregnant;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $adminCount = User::role('admin')->count();
        $doctorCount = User::role('doctor')->count();
        $pregnantCount = Pregnant::count();
        $breastfeedingCount = Breastfeeding::count();
        $childCount = Child::count();
        $childCount = Organisation::count();
    
        return view('admin.index', compact(
            'adminCount',
            'doctorCount',
            'pregnantCount',
            'breastfeedingCount',
            'childCount',
            'organisationCount'
        ));
    }
}
