@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="py-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/appointments">Appointments</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Examination</li>
                    </ol>
                </nav>
                <h2 class="h4">Examination</h2>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="/admin/patients/{{$appointment->patient->id}}"
                    class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    View Patient Info
                </a>
            </div>
        </div>

        <div class="card card-body border-0 shadow table-wrapper table-responsive">

            <div class="row mb-4">
                <div class="row">
                    <div class="col-lg-8 col-sm-6">
                        <div class="mb-4">
                            <label for="notes">Date</label>
                            <p>{{$appointment->date}}</p>
                            <p>{{$appointment->time}}</p>

                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="mb-4">
                            <label for="notes">Status</label>
                            <p class="font-weight-bold status-{{$appointment->status}}">@if ($appointment->status
                                === 0)
                                Upcoming
                                @elseif($appointment->status === 1)
                                Completed
                                @elseif($appointment->status === 2)
                                Cancelled
                                @endif</p>

                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <div class="mb-4">
                            <label for="notes">Patient</label>
                            <p>{{$appointment->patient->name}}</p>

                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <div class="mb-4">
                            <label for="notes">Notes</label>
                            <p>{{$appointment->notes}}</p>

                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <div class="mb-4">
                            <label for="price">Price</label>
                            <p>{{$appointment->price}} USD</p>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->role === 2 && $appointment->price != null)

            <a href="/{{$appointment->id}}/pay" class="btn btn-primary" target="_blank">Pay</a>

            @endif

        </div>
    </div>
</div>
@endsection