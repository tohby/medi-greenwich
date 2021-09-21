@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="py-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/patients">Patients</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View</li>
                    </ol>
                </nav>
                <h2 class="h4">View Patient</h2>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="/admin/patients/{{$patient->id}}/edit"
                    class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                    Edit
                </a>
            </div>
        </div>

        <div class="card card-body border-0 shadow table-wrapper table-responsive">
            <div class="row">
                <div class="col-lg-8">
                    <h6>Name: </h6>
                    <p>{{$patient->name}}</p>
                </div>
                <div class="col-lg-8">
                    <h6>Email: </h6>
                    <p>{{$patient->email}}</p>
                </div>
                <div class="col-lg-8">
                    <h6>Phone number: </h6>
                    <p>{{$patient->phone}}</p>
                </div>
            </div>
        </div>
        <h6 class="my-4 text-muted">Patient Info</h6>
        <div class="card card-body border-0 shadow table-wrapper table-responsive mt-3">
            <div class="row">
                <div class="col-lg-8">
                    <h6>DOB (age): </h6>
                    @if ($patient->info)
                    <p>{{$patient->info->dob}}
                        ({{\Carbon\Carbon::parse($patient->info->dob)->age}})</p>
                    @else
                    <p>N/A (-)</p>
                    @endif

                </div>
                <div class="col-lg-8">
                    <h6>Height: </h6>
                    <p>{{$patient->info ? $patient->info->height : 'N/A' }} cm</p>
                </div>
                <div class="col-lg-8">
                    <h6>Weight: </h6>
                    <p>{{$patient->info ? $patient->info->weight : 'N/A' }} Kg</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection