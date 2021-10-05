<?php

namespace App\Http\Controllers;

use App\User;
use App\PatientInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = User::where('role', 2)->paginate(10);
        $totalCount = User::where('role', 2)->count();
        $searchKey = '';
        return view('admin/patients/index')->with('patients', $patients)->with('totalCount', $totalCount)->with('searchKey', $searchKey);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/patients/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate new patient data
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255', 'regex:/^([^0-9]*)$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'numeric'],
            'dob' => ['required', 'date'],
            'weight' => ['required'],
            'height' => ['required'],
        ]);

        // store new patient data

        $patient = User::Create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 2,
        ]);
        $patientInfo = PatientInfo::firstOrCreate(
            ['patientId' => $patient->id],
            [
                'dob' => $request->dob, 
                'height' => $request->height,
                'weight' => $request->weight,
            ]
        );

        return redirect('admin/patients')->with('success', 'New Patient has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = User::find($id);
        return view('admin/patients/view')->with('patient', $patient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //show edit page 
        $patient = User::find($id);
        return view('admin/patients/edit')->with('patient', $patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate patient data
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'numeric'],
            'dob' => ['required', 'date'],
            'weight' => ['required'],
            'height' => ['required'],
        ]);

        $patient = User::find($id);
        $patient->name = $request->name;
        $patient->email = $request->email;
        $patient->phone = $request->phone;
        $patient->save();

        $patientInfo = PatientInfo::firstOrCreate(
            ['patientId' => $patient->id],
            [
                'dob' => $request->dob, 
                'height' => $request->height,
                'weight' => $request->weight,
            ]
        );

        return redirect('/admin/patients')->with('success', 'Account details have been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $patient = User::find($id);
        $patient->delete();
        return redirect('/admin/patients')->with('success', 'Patient has been removed');
    }
}
