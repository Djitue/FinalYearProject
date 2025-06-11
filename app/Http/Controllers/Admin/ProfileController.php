<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.edit-profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user(); // get the currently authenticated admin

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Assign the fields manually
        $admin = Auth::user(); // get the currently authenticated admin

         // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if it exists
            if ($admin->profile_picture && \Storage::exists($admin->profile_picture)) {
                Storage::delete($admin->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $admin->profile_picture = $path;
        }

        
        // Update other fields
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;

        $admin->save(); // Save changes to the database

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function changePasswordForm()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.change-password', compact('admin'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match']);
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->route('admin.dashboard')->with('success', 'Password changed successfully.');
    }

    public function destroy(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // Delete profile picture from storage if it exists
        if ($admin->profile_picture) {
            Storage::disk('public')->delete($admin->profile_picture);
        }

        // Log out the admin before deleting the account
        Auth::guard('admin')->logout();

        // Delete the account
        $admin->delete();

        // Redirect to homepage or login with a message
        return redirect('/')->with('success', 'Your account has been deleted successfully.');
    }
}
