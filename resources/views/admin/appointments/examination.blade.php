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
                <a href="/admin/patients/{{$appointment->patient->id}}" class=" btn btn-sm btn-gray-800 d-inline-flex
                    align-items-center">
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
            <form action="{{action("AppointmentController@update", "$appointment->id")}}" method="post">
                @csrf
                <div class="row mb-4">
                    <div class="row">
                        <div class="col-lg-8 col-sm-12">
                            <div class="mb-4">
                                <label for="notes">Notes</label>
                                <div class="input-group">
                                    <textarea class="form-control @error('notes') is-invalid @enderror" type="te"
                                        name="notes" placeholder="Notes" required rows='5'></textarea>
                                </div>
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-12">
                            <div class="mb-4">
                                <label for="price">Price</label>
                                <input type="number" min="1" class="form-control @error('price') is-invalid @enderror"
                                    name="price" aria-describedby="name" required>
                                @error('price')
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
                @method('PUT')
            </form>
        </div>
    </div>
</div>
@endsection