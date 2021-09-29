@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="py-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Appointments</li>
                    </ol>
                </nav>
                <h2 class="h4">Appointments</h2>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="/admin/appointments/create" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create an appointment
                </a>
            </div>
        </div>
    </div>
    <div class="table-settings mb-4">
        <div class="row align-items-center justify-content-between">
            <div class="col col-md-6 col-lg-3 col-xl-4">
                <form id="appointments-search-form" action="{{ action("SearchController@appointments") }}"
                    method="POST">
                    @csrf
                    <div class="input-group me-2 me-lg-3 fmxw-400">
                        <span class="input-group-text">
                            <svg class="icon icon-xs" x-description="Heroicon name: solid/search"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <input type="text" class="form-control" name="searchKey" placeholder="Search patients"
                            value="{{$searchKey}}" required>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="col-12 px-0 mb-4">
        @if ($appointments->count() < 1) <div class="text-center">
            No appointments
    </div>
    @else
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0 rounded">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start">Appointment ID</th>
                        @unless (Auth::user()->role === 1)
                        <th class="border-0">Doctor</th>
                        @endunless
                        @unless (Auth::user()->role === 2)
                        <th class="border-0">Patient</th>
                        @endunless
                        <th class="border-0">Description</th>
                        <th class="border-0">Status</th>
                        <th class="border-0">Date</th>
                        <th class="border-0">Time</th>
                        <th class="border-0 d-flex justify-content-end">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)

                    <tr>
                        <td class="border-0 fw-bold">Appointment #{{$appointment->id}}</td>
                        @unless (Auth::user()->role === 1)
                        <td class="border-0 fw-bold">{{$appointment->doctor->name}}</td>
                        @endunless
                        @unless (Auth::user()->role === 2)
                        <td class="border-0 fw-bold">{{$appointment->patient->name}}</td>
                        @endunless
                        <td class="border-0 fw-bold">{{$appointment->description}}</td>
                        <td class="border-0">
                            <div class="d-flex align-items-center status-{{$appointment->status}}"><svg
                                    class="icon icon-xs me-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg> <span class="fw-bold">
                                    @if ($appointment->status === 0)
                                    Upcoming
                                    @elseif ($appointment->status === 1)
                                    Completed
                                    @else
                                    Cancelled
                                    @endif
                                </span>
                            </div>
                        </td>
                        <td class="border-0 fw-bold">
                            {{\Carbon\Carbon::parse($appointment->date)->toFormattedDateString()}}</td>
                        <td class="border-0 fw-bold">{{$appointment->time}}</td>

                        <td class="border-0 fw-bold d-flex justify-content-end">
                            <a href="/admin/appointments/{{$appointment->id}}" class="btn btn-primary me-2">View</a>
                            @if (Auth::user()->role === 1 && $appointment->status === 0)
                            <a href="/admin/appointments/{{$appointment->id}}/edit"
                                class="btn btn-primary me-2">Examine</a>
                            @endif
                            @unless ($appointment->status === 2)
                            <form method="POST" action="{{ route('appointments.destroy',$appointment->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button class="btn btn-danger" type="submit">Cancel</button>
                            </form>
                            @endunless
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
</div>
@endsection