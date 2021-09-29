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
    <div class="table-settings mb-4">
        <div class="row align-items-center justify-content-between">
            <div class="col col-md-6 col-lg-3 col-xl-4">
                <form id="patient-search-form" action="{{ action("SearchController@pharmacy") }}" method="POST">
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
                        <input type="text" class="form-control" name="searchKey" placeholder="Search drugs"
                            value="{{$searchKey}}" required>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="row px-0 mb-4">
        @foreach ($drugs as $drug)
        <div class="col-lg-5 col-xl-3 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="col-lg-5"><strong class="h4">{{$drug->name}}</strong> - <h6
                            class="text-muted float-right">
                            {{$drug->price}}
                            USD</h6>
                    </div>
                    <div class="col-lg-7">
                        <a href="pharmacy/{{$drug->id}}/edit"
                            class="btn btn-primary btn-sm mb-2 me-2">&nbsp;Edit&nbsp;</a>
                        <a href="pharmacy/{{$drug->id}}" class="btn btn-primary btn-sm mb-2 me-2">&nbsp;View&nbsp;</a>
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