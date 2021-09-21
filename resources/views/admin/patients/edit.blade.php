@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="py-1">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-1">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/patients">Patients</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
                <h2 class="h4">Edit Patient</h2>
            </div>
        </div>

        <div class="card card-body border-0 shadow table-wrapper table-responsive">
            <form action="{{action("PatientsController@update", "$patient->id")}}" method="post">
                @csrf
                <div class="row mb-4">
                    <div class="col-lg-8 col-sm-12">
                        <div class="mb-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                aria-describedby="name" value="{{$patient->name}}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <div class="mb-4">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                aria-describedby="email" value="{{$patient->email}}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <div class="mb-4">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                aria-describedby="phone" value="{{$patient->phone}}">
                        </div>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <div class="mb-4">
                            <label for="phone">DOB</label>
                            <div class="input-group date" id="datetimepicker">
                                <input data-datepicker="" class="form-control @error('dob') is-invalid @enderror"
                                    id="dob" type="date" name="dob" placeholder="dd/mm/yyyy"
                                    value="{{$patient->info ? $patient->info->dob : '' }}" required>
                            </div>
                        </div>
                        @error('dob')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-4">
                            <label for="phone">Height</label>
                            <input type="number" class="form-control @error('height') is-invalid @enderror"
                                name="height" aria-describedby="phone"
                                value="{{$patient->info ? $patient->info->height : '' }}" required>
                        </div>
                        @error('height')
                        <span class=" invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-4">
                            <label for="phone">Weight</label>
                            <input type="number" class="form-control @error('weight') is-invalid @enderror"
                                name="weight" aria-describedby="phone"
                                value="{{$patient->info ? $patient->info->weight : '' }}" required>
                        </div>
                        @error('weight')
                        <span class=" invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="float-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                @method('PUT')
            </form>
        </div>
    </div>
</div>
@endsection