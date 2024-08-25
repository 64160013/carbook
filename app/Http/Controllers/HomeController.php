<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('adminHome');
    }

    /**
     * Show the application dashboard.
     *
     * 
     */
        public function showAddVehicleForm()
    {
        return view('addVehicle');
    }

    public function storeVehicle(Request $request)
{
    // Validate the input
    $request->validate([
        'car_type' => 'required|string|max:255',
        'car_regnumber' => 'required|string|max:255',
    ]);

    // Store the data into the database (Assuming a Vehicle model exists)
    \App\Models\Vehicle::create([
        'car_regnumber' => $request->car_regnumber,
        'car_status' => 'Y', // or 'N', depending on your logic
        'car_reason' => $request->car_reason, // Assuming you have this field in your form
    ]);
    

    // Redirect back with a success message
    return redirect()->route('add.vehicle')->with('success', 'Vehicle added successfully!');
}


}
