@extends('layouts.template')
@section('content')

<div class="row mb-3">
    <div class="col-12">
        <div class="btn-group" role="group" aria-label="Filter Applications">
            <a href="{{ route('volunteers.status', ['user' => Auth::user()->id, 'status' => '']) }}" class="btn btn-secondary {{ is_null($status) ? 'active' : '' }}">All</a>
            <a href="{{ route('volunteers.status', ['user' => Auth::user()->id, 'status' => 'accepted']) }}" class="btn btn-success {{ $status === 'Accepted' ? 'active' : '' }}">Accepted</a>
            <a href="{{ route('volunteers.status', ['user' => Auth::user()->id, 'status' => 'rejected']) }}" class="btn btn-danger {{ $status === 'Rejected' ? 'active' : '' }}">Rejected</a>
            <a href="{{ route('volunteers.status', ['user' => Auth::user()->id, 'status' => 'pending']) }}" class="btn btn-warning {{ $status === 'Pending' ? 'active' : '' }}">Pending</a>
        </div>
    </div>
</div>

@if($applications->count() > 0)
    <div class="row row-cols-2">
        @foreach ($applications as $a)
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ Storage::url($a->event->poster) }}" alt="" style="height: 200px; width: 150px">
                            </div>
                            <div class="col-8">
                                <dl class="row">
                                    <dt class="col-3">Event Title</dt>
                                    <dd class="col-9">{{ $a->event->title }}</dd>

                                    <dt class="col-3">Description</dt>
                                    <dd class="col-9">{{ $a->event->description }}</dd>

                                    <dt class="col-3">Date</dt>
                                    <dd class="col-9">{{ $a->event->start_date }} to {{ $a->event->end_date }}</dd>

                                    <dt class="col-3">Location</dt>
                                    <dd class="col-9">{{ $a->event->location }}</dd>

                                    <dt class="col-3">Volunteers Needed</dt>
                                    <dd class="col-9">{{ $a->event->num_of_needed_vol }}</dd>
                                </dl>
                                <div class="btn-row text-end">
                                    <a href="{{ route('volunteers.applicationDetails', $a->id) }}" class="btn btn-primary">More Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">No applications found for this status.</p>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection
