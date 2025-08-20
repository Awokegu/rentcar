<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\car;

class VehicleController extends Controller
{
    public function map()
    {
        $cars = car::all(); // Make sure your table has latitude & longitude
        return view('car.map', compact('cars'));
    }
}
