<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PregnantDashboardController extends Controller
{
    public function index(){
        return view('pregnant.index');
    }
}
