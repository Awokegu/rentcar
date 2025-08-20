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
        'new_password' => 'required|min:6|confirmed',
    ]);

    // Get the currently authenticated user
    $user = Auth::user();

    // Check if the current password is correct
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect']);
    }

    // Update the user's password
    $user->password = Hash::make($request->new_password);
    $user->save();
    
    // Logout the user
    Auth::logout();

    // Redirect to login page with success message
    return redirect()->route('login')->with('success', 'Password updated successfully. Please login with your new password.');
}
}