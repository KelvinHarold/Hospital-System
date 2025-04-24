<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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
        
        return $pdf->download('report-'.$report->id.'.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('reports.show', compact('report'));
    }
    public function share(Request $request)
    {
        $request->validate([
            'report_type' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:2048'
        ]);
    
        $user = User::find(auth()->id());
        $role = $user->getRoleNames()->first();
    
        // Use uploaded file if present, otherwise reuse file path
        $filePath = null;
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/reports', $fileName, 'public');
        } elseif ($request->has('existing_file_path')) {
            $filePath = $request->input('existing_file_path');
        }
    
        Organisation::create([
            'user_id' => $user->id,
            'role' => $role,
            'email' => $request->input('email'), // Store selected user's email
            'report_type' => $request->input('report_type'),
            'description' => $request->input('description'),
            'file_path' => $filePath,
        ]);
        
    
        return redirect()->route('reports.index')->with('success', 'Report shared to organisation!');
    }

    public function getUsersByRole($role)
{
    // Get users by role and return email
    $users = Role::findByName($role)->users()->get(['id', 'email']);
    return response()->json($users);
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
