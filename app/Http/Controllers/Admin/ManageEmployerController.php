<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageEmployerController extends Controller
{
     public function index()
    {
        $employers = Employer::all();
        return view('admin.employers.index', compact('employers'));
    }

    public function create()
    {
        return view('admin.employers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employers,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:255'
        ]);

        $validated['password'] = bcrypt($validated['password']);

        Employer::create($validated);

        return redirect()->route('employers.index')->with('success', 'Employer created successfully.');
    }

    public function show($id)
    {
        $employer = Employer::findOrFail($id);
        return view('admin.employers.show', compact('employer'));
    }

    public function edit($id)
    {
        $employer = Employer::findOrFail($id);
        return view('admin.employers.edit', compact('employer'));
    }

    public function update(Request $request, $id)
    {
        $employer = Employer::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employers,email,' . $id,
            'phone' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);
        
        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }
        
        $employer->update($validated);

        return redirect()->route('employers.index')->with('success', 'Employer updated successfully.');
    }

    public function destroy($id)
    {
        $employer = Employer::findOrFail($id);
        $employer->delete();

        return redirect()->route('employers.index')->with('success', 'Employer deleted successfully.');
    }
}
