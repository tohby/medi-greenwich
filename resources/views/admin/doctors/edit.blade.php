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
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
                <h2 class="h4">Edit Doctor</h2>
            </div>
        </div>

        <div class="card card-body border-0 shadow table-wrapper table-responsive">
            <form action="{{action("DoctorsController@update", "$doctor->id")}}" method="post">
                @csrf
                <div class="row mb-4">
                    <div class="col-lg-8 col-sm-12">
                        <div class="mb-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                aria-describedby="name" value="{{$doctor->name}}" required>
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
                                aria-describedby="email" value="{{$doctor->email}}" required>
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
                                aria-describedby="phone" value="{{$doctor->phone}}">
                        </div>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
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