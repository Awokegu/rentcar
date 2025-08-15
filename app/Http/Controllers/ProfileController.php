<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function editPassword()
    {
        return view('profile.change-password');
    }

   public function updatePassword(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed|regex:/[A-Z]/|regex:/[0-9]/',
    ]);

    //  Debugging: Display the incoming request data
    // dd($request->all());

    // Get the currently authenticated user
    $user = Auth::user();

    // Check if the current password is correct
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect']);
    }

    // Update the user's password
    $user->password = Hash::make($request->new_password);
    $user->save();
    
    // Re-login the user so session stays valid
    Auth::login($user);
    return back()->with('success', 'Password updated successfully.');
}
}
