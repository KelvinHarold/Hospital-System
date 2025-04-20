<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    
    public function index()
    {
        $reports = Report::all();
        return view('reports.index', compact('reports'));
    }
    
    public function create(Request $request)
    {
        $reportTypes = DB::select("SHOW COLUMNS FROM reports WHERE Field = 'report_type'");
        preg_match('/enum\((.*)\)/', $reportTypes[0]->Type, $matches);
        $enumValues = array_map(function ($value) {
            return trim($value, "'");
        }, explode(',', $matches[1]));
    
        return view('reports.create', compact('enumValues'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'report_type' => 'required|string',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        ]);
    
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('reports', 'public');
        }
    
        Report::create([
            'user_id' => Auth::id(),
            'report_type' => $request->report_type,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);
    
        return redirect()->route('reports.index')->with('success', 'Report submitted!');
    }
    
    public function print(Report $report)
    {
        $pdf = PDF::loadView('reports.pdf', compact('report'));
        
        return $pdf->stream('report-'.$report->id.'.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
}
}
