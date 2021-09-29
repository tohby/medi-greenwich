<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

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

    public function checkout(Request $request) {
        $appointment = Appointment::find($request->appointmentId);
        $charge = Stripe::charges()->create([
            'amount' => $appointment->price,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Order',
            'receipt_email' => $appointment->patient->email,
        ]);
        // if($charge) {
        //     $appointment 
        // }

        return redirect('admin/appointments')->with('success', 'Your invoice has been paid');
    }
}
