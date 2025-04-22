<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\User; // ✅ Correct import
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    public function index()
    {
        return view('organisation.index');
    }

   
}
