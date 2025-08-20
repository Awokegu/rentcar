<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;
use App\Models\Reservation;
use App\Models\ContactMessage; // Import the ContactMessage model

class adminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Fetch counts and data for the dashboard
        $clients = User::where('role', 'client')->count();
        $admins = User::where('role', 'admin')->count();
        $cars = Car::all();
        $reservations = Reservation::paginate(10);
        $avatars = User::all();

        // Return the admin dashboard view with all necessary data
        $activeReservationsCount = Reservation::where('status', 'Active')->count();

         return view('admin.adminDashboard', compact('clients', 'avatars', 'admins', 'cars', 'reservations', 'activeReservationsCount'));

    }

    /**
     * Show the contact messages.
     */
    public function showContactMessages(Request $request)
    {
        // Fetch contact messages with pagination
        $messages = ContactMessage::paginate(10); // Adjust the number based on your needs

        // Return the view for displaying contact messages
        return view('admin.contactMessages', compact('messages'));
    }
    public function destroy($id)
{
    $message = ContactMessage::findOrFail($id);
    $message->delete();

    return redirect()->route('admin.contactMessages')->with('success', 'Message deleted successfully.');
}
}