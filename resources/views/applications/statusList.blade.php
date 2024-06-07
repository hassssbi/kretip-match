@extends('layouts.template')
@section('content')

<div class="row mb-3">
    <div class="col-12">
        <div class="btn-group" role="group" aria-label="Filter Applications">
            <a href="{{ route('volunteers.status', ['status' => '']) }}" class="btn btn-secondary {{ is_null($status) ? 'active' : '' }}">All</a>
            <a href="{{ route('volunteers.status', ['status' => 'accepted']) }}" class="btn btn-success {{ $status === 'Accepted' ? 'active' : '' }}">Accepted</a>
            <a href="{{ route('volunteers.status', ['status' => 'rejected']) }}" class="btn btn-danger {{ $status === 'Rejected' ? 'active' : '' }}">Rejected</a>
            <a href="{{ route('volunteers.status', ['status' => 'pending']) }}" class="btn btn-warning {{ $status === 'Pending' ? 'active' : '' }}">Pending</a>
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
                                    <dt class="col-4">Event Title</dt>
                                    <dd class="col-8">{{ $a->event->title }}</dd>

                                    <dt class="col-4">Description</dt>
                                    <dd class="col-8">{{ $a->event->description }}</dd>

                                    <dt class="col-4">Date</dt>
                                    <dd class="col-8">{{ $a->event->start_date }} to {{ $a->event->end_date }}</dd>

                                    <dt class="col-4">Location</dt>
                                    <dd class="col-8">{{ $a->event->location }}</dd>

                                    <dt class="col-4">Volunteers Needed</dt>
                                    <dd class="col-8">{{ $a->event->assignedUsers()->count() }} / {{ $a->event->num_of_needed_vol }}</dd>

                                    <dt class="col-4">Status</dt>
                                    <dd class="col-8">
                                        <div class="badge text-md {{ $a->status == 'Accepted' ? 'badge-success' : ($a->status == 'Rejected' ? 'badge-danger' : 'badge-warning') }}">{{ Str::upper($a->status) }}</div>
                                    </dd>
                                </dl>
                                <div class="btn-row text-end">
                                    <a href="{{ route('volunteers.statusDetails', $a->id) }}" class="btn btn-primary">More Details</a>
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
