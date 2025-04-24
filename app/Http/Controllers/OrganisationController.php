<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Report;
use App\Models\User; // ✅ Correct import
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    public function index()
    {
        $reports = Report::all();
        return view('organisation.index', compact('reports'));
    }

    public function show($id)
{
    $report = \App\Models\Report::findOrFail($id);
    return view('organisation.show', compact('report'));
}

public function destroy($id)
{
    $report = \App\Models\Report::findOrFail($id);
    $report->delete();
    return redirect()->route('organisation.index')->with('success', 'Report deleted successfully!');
}

   
}
