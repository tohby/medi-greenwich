@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="py-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/rooms">Rooms</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
                <h2 class="h4">Add new Room</h2>
            </div>
        </div>

        <div class="card card-body border-0 shadow table-wrapper table-responsive">
            <form action="{{action("RoomsController@store")}}" method="post">
                @csrf
                <div class="row mb-4">
                    <div class="col-lg-8 col-sm-12">
                        <div class="mb-4">
                            <label for="description">Description</label>
                            <textarea rows="3" class="form-control @error('description') is-invalid @enderror"
                                name="description" aria-describedby="name" required></textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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