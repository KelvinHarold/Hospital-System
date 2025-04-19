<?php

namespace App\Http\Controllers;

use App\Models\Breastfeeding;
use Illuminate\Http\Request;
use App\Models\Child; // Import the Child model
use Illuminate\Support\Facades\Auth;

class BreastfeedingWomanController extends Controller
{
    public function index()
    {
       return view('breastfeeding.index');
    }

    public function show()
    {
        // Get the logged-in user's breastfeeding record where role is breastfeeding-woman
        $userId = Auth::user()->id;
        $breastfeedingDetails = Breastfeeding::where('user_id', $userId)->first();

        return view('breastfeeding.show', compact('breastfeedingDetails'));
    }

   // BreastfeedingWomanController.php
// BreastfeedingWomanController.php
public function childshow()
{
    // Get the logged-in user's children along with their child records
    $userId = Auth::user()->id;
    $children = Child::where('mother_id', $userId) // Assuming mother_id is related to the breastfeeding woman
                    ->with('records') // Eager load child records
                    ->get();

    // Prepare data for the graph
    $graphData = [];
    foreach ($children as $child) {
        $graphData[] = [
            'child_name' => $child->name,
            'records' => $child->records->map(function ($record) {
                return [
                    'record_date' => \Carbon\Carbon::parse($record->record_date)->format('M d, Y'),
                    'weight' => $record->weight,
                    'height' => $record->height,
                    'head_circumference' => $record->head_circumference,
                ];
            })
        ];
    }

    return view('breastfeeding.child', compact('children', 'graphData'));
}



}
