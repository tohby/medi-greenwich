<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function pay($id) {
        $appointment = Appointment::find($id);
        return view('admin/appointments/payment')->with('appointment', $appointment);
    }

    public function checkout() {
        
    }
}
