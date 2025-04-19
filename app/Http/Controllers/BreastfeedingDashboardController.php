<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BreastfeedingDashboardController extends Controller
{
    public function index(){
        return view('breastfeeding.index');
    }
}
