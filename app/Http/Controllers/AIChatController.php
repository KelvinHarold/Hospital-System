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
    
        // Full path to your Python script
        $scriptPath = base_path('python-scripts/ask_model.py');
    
        $process = new Process(['python', $scriptPath, $question]);
    
        try {
            $process->mustRun();
            return response()->json(['answer' => $process->getOutput()]);
        } catch (ProcessFailedException $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }
}
