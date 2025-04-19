<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorChildrenController extends Controller
{
    public function index()
    {
        $childs = Child::all();
        return view('doctor.children.index', compact('childs'));
    }

    public function create(Request $request)
    {
        $mother_id = $request->mother_id;
        $mother_type = $request->mother_type;
    
        // Get all children of this mother
        $children = Child::where('user_id', $mother_id)->get(); // or 'mother_id' if you're using that
    
        return view('doctor.children.create', compact('mother_id', 'mother_type', 'children'));
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'head_circumference' => 'required|numeric',
            'notes' => 'nullable|string',
            'mother_id' => 'required|integer|exists:users,id',
            'mother_type' => 'required|string',
        ]);

        // Automatically create a new User for the child
        $childUser = User::create([
            'name' => $validated['name'],
            'email' => $validated['name'] . '@example.com', // Placeholder email, you may change this logic
            'password' => bcrypt('defaultpassword'), // Default password or logic for password
        ]);

        // Create the child record with the newly created user's ID
        $child = new Child([
            'name' => $validated['name'],
            'birth_date' => $validated['birth_date'],
            'weight' => $validated['weight'],
            'height' => $validated['height'],
            'head_circumference' => $validated['head_circumference'],
            'notes' => $validated['notes'] ?? null,
            'mother_id' => $validated['mother_id'],
            'mother_type' => $validated['mother_type'],
            'user_id' => $childUser->id, // Assign the newly created child's user ID
        ]);

        $child->save();

        return redirect()->route('doctor.breastfeeding.index')->with('success', 'Child record added successfully.');
    }

    public function show($child_user_id)
    {
        $childUser = User::findOrFail($child_user_id);
        $children = Child::where('user_id', $child_user_id)->get();

        return view('doctor.children.show', compact('childUser', 'children'));
    }

    public function edit($id)
    {
        $child = Child::findOrFail($id);
        return view('doctor.children.edit', compact('child'));
    }

    public function update(Request $request, $id)
    {
        $child = Child::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'head_circumference' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        $child->update($request->only([
            'name',
            'birth_date',
            'weight',
            'height',
            'head_circumference',
            'notes',
        ]));

        return redirect()->route('doctor.children.show', $child->user_id)->with('success', 'Child record updated.');
    }

    public function destroy(string $id)
    {
        $child = Child::findOrFail($id);
        $child->delete();

        return back()->with('success', 'Child deleted successfully.');
    }
}
