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
@if($events->count() > 0)
<div class="row row-cols-2">
    @foreach ($events as $e)
        @if(!$e->isFull() && !$e->isCompleted())
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ Storage::url($e->poster) }}" alt="" style="height: 200px; width: 150px">
                            </div>
                            <div class="col-8">
                                <dl class="row">
                                    <dt class="col-4">Event Title</dt>
                                    <dd class="col-8">{{ $e->title }}</dd>

                                    <dt class="col-4">Description</dt>
                                    <dd class="col-8">{{ $e->description }}</dd>

                                    <dt class="col-4">Date</dt>
                                    <dd class="col-8">{{ $e->start_date }} to {{ $e->end_date }}</dd>

                                    <dt class="col-4">Location</dt>
                                    <dd class="col-8">{{ $e->location }}</dd>

                                    <dt class="col-4">Volunteers Needed</dt>
                                    <dd class="col-8">{{ $e->assignedUsers()->count() }} / {{ $e->num_of_needed_vol }}</dd>

                                    <dt class="col-4">Skills</dt>
                                    <dd class="col-8">
                                        {{ $e->skills->implode('name', ', ') ?: 'No specific skills required.' }}
                                    </dd>

                                    <dt class="col-4">Moderator</dt>
                                    <dd class="col-8">
                                        {{ $e->moderator->name }}
                                    </dd>
                                </dl>
                                <div class="btn-row text-end">
                                    <a href="{{ route('volunteers.eventDetails', $e->id) }}" class="btn btn-primary">More Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="card-text">No events for now.</p>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
