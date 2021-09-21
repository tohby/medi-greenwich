@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="py-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pharmacy</li>
                    </ol>
                </nav>
                <h2 class="h4">Pharmacy</h2>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="/admin/pharmacy/create" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Drugs to pharmacy
                </a>
            </div>
        </div>
    </div>
    <div class="row px-0 mb-4">
        @foreach ($drugs as $drug)
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body d-flex">
                    <div class="col-lg-8"><strong class="h4">{{$drug->name}}</strong> - <h6
                            class="text-muted float-right">
                            {{$drug->price}}
                            USD</h6>
                    </div>
                    <div class="col-lg-4">
                        <a href="pharmacy/{{$drug->id}}/edit" class="btn btn-primary btn-sm mb-2">Edit</a>
                        <a href="pharmacy/{{$drug->id}}" class="btn btn-primary btn-sm mb-2">View</a>
                        <form method="POST" action="{{ route('pharmacy.destroy',$drug->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection