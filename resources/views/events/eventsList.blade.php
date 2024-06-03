@extends('layouts.template')
@section('content')

<div class="row mb-3">
    <div class="col-md-6">
        <form action="{{ route('volunteers.events') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search for events..." value="{{ request()->query('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
</div>
@if(Request::routeIs('volunteers.events'))
    @if($events->count() > 0)
        <div class="row row-cols-2">
            @foreach ($events as $e)
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img src="{{ Storage::url($e->poster) }}" alt="" style="height: 200px; width: 150px">
                                </div>
                                <div class="col-8">
                                    <dl class="row">
                                        <dt class="col-3">Event Title</dt>
                                        <dd class="col-9">{{ $e->title }}</dd>

                                        <dt class="col-3">Description</dt>
                                        <dd class="col-9">{{ $e->description }}</dd>

                                        <dt class="col-3">Date</dt>
                                        <dd class="col-9">{{ $e->start_date }} to {{ $e->end_date }}</dd>

                                        <dt class="col-3">Location</dt>
                                        <dd class="col-9">{{ $e->location }}</dd>

                                        <dt class="col-3">Volunteers Needed</dt>
                                        <dd class="col-9">{{ $e->num_of_needed_vol }}</dd>
                                    </dl>
                                    <div class="btn-row text-end">
                                        <a href="{{ route('volunteers.eventDetails', $e->id) }}" class="btn btn-primary">More Details</a>
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
@else
@if($assignedEvents->count() > 0)
    <div class="row row-cols-2">
        @foreach ($assignedEvents as $a->event)
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
                                    <a href="{{ route('volunteers.eventDetails', $a->event->id) }}" class="btn btn-primary">More Details</a>
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
@endif

@endsection
