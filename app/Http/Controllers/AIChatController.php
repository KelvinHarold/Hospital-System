<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class AIChatController extends Controller
{
    public function index()
    {
        return view('AI.index');
    }
    public function ask(Request $request)
    {
        $question = $request->input('question');
        
        // Correctly escape the Python script path and the question argument
        $scriptPath = base_path('python-scripts/medical_qa.py');  // No need to add extra quotes
        
        // Escape the question input properly
        $escapedQuestion = escapeshellarg($question);
        
        // Build the process with the script path and question
        $process = new Process([
            'python', 
            $scriptPath, 
            $escapedQuestion  // Escape the question to handle special characters
        ]);
    
        try {
            $process->mustRun();
            return response()->json(['answer' => $process->getOutput()]);
        } catch (ProcessFailedException $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }
    
    
    
}
