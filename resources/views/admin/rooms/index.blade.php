@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="py-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rooms</li>
                    </ol>
                </nav>
                <h2 class="h4">All Rooms</h2>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="/admin/rooms/create" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Room
                </a>
            </div>
        </div>
        <div class="col-12 px-0 mb-4">
            @if ($rooms->count() < 1) no rooms to show @else <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0 rounded-start">Room ID</th>
                                    <th class="border-0">Description</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">#</th>
                                    {{-- <th class="border-0">Travel &amp; Local Change</th>
                                    <th class="border-0">Widgets</th>
                                    <th class="border-0 rounded-end">Widgets Change</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                <tr>
                                    <td class="border-0 fw-bold">Room #{{$room->id}}</td>
                                    <td class="border-0 fw-bold">{{$room->description}}</td>
                                    <td class="border-0 {{$room->status === 1 ? 'text-danger' : 'text-primary'}}">
                                        <div class="d-flex align-items-center"><svg class="icon icon-xs me-1"
                                                fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg> <span
                                                class="fw-bold">{{$room->status === 1 ? 'tOccupied' : 'Available'}}</span>
                                        </div>
                                    </td>
                                    <td class="border-0 fw-bold text-danger">
                                        <form method="POST" action="{{ route('rooms.destroy',$room->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
        @endif
    </div>
</div>
</div>
@endsection