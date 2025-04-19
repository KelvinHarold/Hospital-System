<?php

namespace App\Http\Controllers;

use App\Models\Pregnant;
use Illuminate\Http\Request;
use Illuminate\View\ViewServiceProvider;
use Illuminate\Support\Facades\Auth;

class PregnantWomanController extends Controller
{
    public function index(){
        return view('pregnant.index');
    }

    public function show()
    {
        // Get the logged-in user's breastfeeding record where role is breastfeeding-woman
        $userId = Auth::user()->id;
        $pregnantDetails = Pregnant::where('user_id', $userId)->first();

        return view('pregnant.show', compact('pregnantDetails'));
    }
  
}
