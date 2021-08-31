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
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
                <h2 class="h4">Create an appointment</h2>
            </div>
        </div>

        <div class="card card-body border-0 shadow table-wrapper table-responsive">
            <form action="{{action("AppointmentController@store")}}" method="post">
                @csrf
                <div class="row mb-4">
                    <div class="col-lg-8 col-sm-8 mb-2">
                        <a href="#" class="btn btn-link" data-bs-toggle="collapse" data-bs-target=".multi-collapse"
                            aria-expanded="false" aria-controls="create-new-patient selectPatient">Create New
                            Patient</a>
                    </div>
                    <div id="create-new-patient" class="collapse multi-collapse">
                        @include('admin/appointments/newPatientForm')
                    </div>
                    <div id="selectPatient" class="collapse multi-collapse show">
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-4">
                                <label for="name">Select patient</label>
                                <select class="form-select" aria-label="Default select patient">
                                    <option value="" selected>Select Patient</option>
                                    @foreach ($patients as $patient)
                                    <option value="{{$patient->id}}">{{$patient->name}}</option>
                                    @endforeach

                                </select>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="mb-4">
                                <label for="name">Date</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    aria-describedby="name" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="mb-4">
                                <label for="name">Time</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    aria-describedby="name" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="float-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection