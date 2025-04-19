<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DoctorController extends Controller
{
    public function index()
    {
        // Counts for different user roles
        $pregnantWomenCount = User::role('pregnant-woman')->count();
        $breastfeedingWomenCount = User::role('breastfeeding-woman')->count();
        $childrenCount = User::role('Child')->count();

        /// Sample data for children and pregnant diseases
        $childrenDiseases = [
            ['name' => 'Disease 1', 'count' => 5],
            ['name' => 'Disease 2', 'count' => 10],
            ['name' => 'Disease 3', 'count' => 15],
            // Add more diseases as needed
        ];

        $pregnantDiseases = [
            ['name' => 'Disease A', 'count' => 8],
            ['name' => 'Disease B', 'count' => 12],
            ['name' => 'Disease C', 'count' => 18],
            // Add more diseases as needed
        ];

        // Convert arrays to collections to use pluck() method
        $childrenDiseases = collect($childrenDiseases);
        $pregnantDiseases = collect($pregnantDiseases);

        // Return the view with the necessary data
        return view('doctor.index', compact('pregnantWomenCount', 'breastfeedingWomenCount', 'childrenCount', 'childrenDiseases', 'pregnantDiseases'));
    }
}

