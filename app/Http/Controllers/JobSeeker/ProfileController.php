<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::guard('web')->user();
        return view('jobseeker.edit-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // get the currently authenticated jobseeker

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|string',
            'skill' => 'nullable|string',
            'age' => 'nullable|string',
            'language' => 'nullable|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Assign the fields manually
        $user = Auth::user(); // get the currently authenticated jobseeker

         // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if it exists
            if ($user->profile_picture && \Storage::exists($user->profile_picture)) {
                Storage::delete($user->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        if ($request->hasFile('cv')) {
            // Delete old CV if it exists
            if ($user->cv && \Storage::exists($user->cv)) {
                Storage::delete($user->cv);
            }

            // Store new CV in the 'cvs' directory
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $user->cv = $cvPath;
        }
        
        // Update other fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->skill = $request->skill;
        $user->age = $request->age;
        $user->language = $request->language;

        $user->save(); // Save changes to the database

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

     public function changePasswordForm()
    {
        $user = Auth::guard('web')->user();
        return view('jobseeker.change-password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::guard('web')->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('jobseeker.dashboard')->with('success', 'Password changed successfully.');
    }

    public function destroy(Request $request)
    {
        $user = Auth::guard('web')->user();

        // Delete profile picture from storage if it exists
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Log out the jobseeker before deleting the account
        Auth::guard('web')->logout();

        // Delete the account
        $user->delete();

        // Redirect to homepage or login with a message
        return redirect('/')->with('success', 'Your account has been deleted successfully.');
    }

}
