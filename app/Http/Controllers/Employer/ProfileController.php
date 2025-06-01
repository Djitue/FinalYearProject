<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $employer = Auth::guard('employer')->user();
        return view('employer.edit-profile', compact('employer'));
    }

    public function update(Request $request)
    {
        $employer = Auth::user(); // get the currently authenticated employer

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employers,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|string',
            'facebook' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Assign the fields manually
        $employer = Auth::user(); // get the currently authenticated employer

         // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if it exists
            if ($employer->profile_picture && \Storage::exists($employer->profile_picture)) {
                Storage::delete($employer->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $employer->profile_picture = $path;
        }

        
        // Update other fields
        $employer->name = $request->name;
        $employer->email = $request->email;
        $employer->phone = $request->phone;
        $employer->address = $request->address;
        $employer->gender = $request->gender;
        $employer->facebook = $request->facebook;
        $employer->linkedin = $request->linkedin;

        $employer->save(); // Save changes to the database

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function changePasswordForm()
    {
        $employer = Auth::guard('employer')->user();
        return view('employer.change-password', compact('employer'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $employer = Auth::guard('employer')->user();

        if (!Hash::check($request->current_password, $employer->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match']);
        }

        $employer->password = Hash::make($request->new_password);
        $employer->save();

        return redirect()->route('employer.dashboard')->with('success', 'Password changed successfully.');
    }

    public function destroy(Request $request)
    {
        $employer = Auth::guard('employer')->user();

        // Delete profile picture from storage if it exists
        if ($employer->profile_picture) {
            Storage::disk('public')->delete($employer->profile_picture);
        }

        // Log out the employer before deleting the account
        Auth::guard('employer')->logout();

        // Delete the account
        $employer->delete();

        // Redirect to homepage or login with a message
        return redirect('/')->with('success', 'Your account has been deleted successfully.');
    }

}
