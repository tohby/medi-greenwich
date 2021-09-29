<?php

namespace App\Http\Controllers;

use App\User;
use App\Room;
use App\Appointment;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function patients(Request $request) {
        $this->validate($request, [
            'searchKey' => 'required',
        ]);
        $patients = User::search($request->searchKey)->where('role', 2)->paginate(12);
        $totalCount = User::search($request->searchKey)->where('role', 2)->get()->count();
        return view('admin/patients/index')->with('patients', $patients)->with('totalCount', $totalCount)->with('searchKey', $request->searchKey);
    }

    public function appointments(Request $request) {
        $this->validate($request, [
            'searchKey' => 'required',
        ]);
        $appointments = Appointment::search($request->searchKey)->paginate(10);
        return view('admin/appointments/index')->with('appointments', $appointments);
    }
}
