@extends('layouts.template')
@section('content')

<div class="row mb-3">
    <div class="col-md-6">
        <form action="{{ route('volunteers.assignedEvents') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search for events..." value="{{ request()->query('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
</div>
@if($assignedEvents->count() > 0)
    <div class="row row-cols-2">
        @foreach ($assignedEvents as $a)
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

                                    <dt class="col-4">Skills</dt>
                                    <dd class="col-8">
                                        {{ $a->event->skills->implode('name', ', ') ?: 'No specific skills required.' }}
                                    </dd>

                                    <dt class="col-4">Event Status</dt>
                                    <dd class="col-8">
                                        <div class="badge text-md {{ $a->event->status == 'Completed' ? 'badge-success' : ($a->event->status == 'Pending' ? 'badge-warning' : 'badge-info') }}">{{ Str::upper($a->event->status) }}</div>
                                    </dd>
                                </dl>
                                <div class="btn-row text-end">
                                    <a href="{{ route('volunteers.assignedEventsDetails', $a->event->id) }}" class="btn btn-primary">More Details</a>
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
                    <p class="card-text">No events has been assigned to you.</p>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
