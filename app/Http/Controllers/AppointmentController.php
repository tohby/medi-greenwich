<?php

namespace App\Http\Controllers;

use App\User;
use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role === 0){
            $appointments = Appointment::orderBy('created_at', 'desc')->paginate(10);
        }elseif(Auth::user()->role === 1){
            $appointments = Appointment::where('doctorId', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        }else{
            $appointments = Appointment::where('patientId', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        }
        $searchKey = '';
        return view('admin/appointments/index')->with('appointments', $appointments)->with('searchKey', $searchKey);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = User::where('role', 2)->get();
        $doctors = User::where('role', 1)->get();
        return view('admin/appointments/create')->with('patients', $patients)->with('doctors', $doctors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'patient' => ['required_without_all:name,email,password'],
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'numeric'],
            'doctor' => ['required'],
        ]);

        if($request->patient){
            $patient = $request->patient;
        }else{
            $newPatient = User::Create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 2,
            ]);
            $patient = $newPatient->id;
        }

        Appointment::Create([
            'doctorId' => $request->doctor,
            'patientId' => $patient,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        return redirect('admin/appointments')->with('success', 'Appointment has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return view('admin/appointments/view')->with('appointment', $appointment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        return view('admin/appointments/examination')->with('appointment', $appointment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
         $this->validate($request, [
            'notes' => ['required'],
            'price' => ['nullable', 'string']
        ]);

        $appointment->notes = $request->notes;
        $appointment->price = $request->price;
        $appointment->status = 1;
        $appointment->save();
        return redirect('admin/appointments')->with('success', 'Examination has been submited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->status = 3;
        $appointment->save();
        return redirect('admin/appointments')->with('success', 'Appointment has been cancelled');
    }
}
