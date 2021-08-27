@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="py-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/doctors">Doctors</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View</li>
                    </ol>
                </nav>
                <h2 class="h4">View Doctor</h2>
            </div>
        </div>

        <div class="card card-body border-0 shadow table-wrapper table-responsive">
            <div class="row">
                <div class="col-lg-8">
                    <h6>Name: </h6>
                    <p>{{$doctor->name}}</p>
                </div>
                <div class="col-lg-8">
                    <h6>Email: </h6>
                    <p>{{$doctor->email}}</p>
                </div>
                <div class="col-lg-8">
                    <h6>Phone number: </h6>
                    <p>{{$doctor->phone}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection