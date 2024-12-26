<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;


class ProfileController extends Controller
{
   public function index()
{
    $user = auth()->user();
    $profile = $user->profile;
    $activityLogs = Activity::where('causer_id', $user->id)->latest()->get();
    return view('users.profile', compact('user', 'profile', 'activityLogs'));
}


public function update(Request $request, $id)
{
    // Find user and profile
    $user = User::findOrFail($id);
    $profile = $user->profile;

    // Validation
    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'phone_number' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'bio' => 'nullable|string',
        'birthdate' => 'nullable|date',
        'gender' => 'nullable|string|in:Male,Female,Other',
        'nationality' => 'nullable|string|max:100',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Update profile info
    $profile->firstname = $request->firstname;
    $profile->lastname = $request->lastname;
    $profile->phone_number = $request->phone_number;
    $profile->address = $request->address;
    $profile->bio = $request->bio;
    $profile->birthdate = $request->birthdate;
    $profile->gender = $request->gender;
    $profile->nationality = $request->nationality;

    // Check if the profile has an existing picture and delete it
    if ($request->hasFile('profile_picture')) {
        // Delete old picture if it exists
        if ($profile->profile_picture && file_exists(storage_path('app/public/' . $profile->profile_picture))) {
            unlink(storage_path('app/public/' . $profile->profile_picture));
        }

        // Upload new image and store it
        $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        $profile->profile_picture = $imagePath;
    }

    // Save the updated profile
    $profile->save();

    // Return success response
    return redirect()->back()->with([
        'success' => 'Profile updated successfully!',
        'icon' => 'success'
    ]);
}



public function updatePicture(Request $request, $id)
{
    $user = User::findOrFail($id);
    $profile = $user->profile;

    // Validation for profile picture
    $request->validate([
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Delete old profile picture if exists
    if ($profile->profile_picture && file_exists(storage_path('app/public/' . $profile->profile_picture))) {
        unlink(storage_path('app/public/' . $profile->profile_picture));
    }

    // Upload new profile picture
    if ($request->hasFile('profile_picture')) {
        $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        $profile->profile_picture = $imagePath;
    }

    $profile->save();

    return redirect()->back()->with([
        'success' => 'Profile picture updated successfully!',
        'icon' => 'success'
    ]);
}


    public function updateAccount(Request $request, $user)
    {
        $user = User::findOrFail($user);

        // Validate the form inputs
        $request->validate([
            'username' => 'required|string|unique:users,username,' . $user->id,
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update username
        $user->username = $request->username;

        // Check if the password needs to be updated
        if ($request->filled('current_password') && $request->filled('new_password')) {
            // Check if the current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }

            // Update password
            $user->password = Hash::make($request->new_password);
        }

        // Save changes
        $user->save();

        return redirect()->back()->with('success', 'Username and/or password updated successfully!');
    }

}
