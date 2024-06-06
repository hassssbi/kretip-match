@extends('layouts.template')
@section('content')

<div class="row">
    <div class="col-12 justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <img src="{{ Storage::url($event->poster) }}" alt="" style="height: 200px">
                    </div>
                    <div class="col-8">
                        <dl class="row">
                            <dt class="col-4">Event Title</dt>
                            <dd class="col-8">{{ $event->title }}</dd>

                            <dt class="col-4">Description</dt>
                            <dd class="col-8">{{ $event->description }}</dd>

                            <dt class="col-4">Date</dt>
                            <dd class="col-8">{{ $event->start_date }} to {{ $event->end_date }}</dd>

                            <dt class="col-4">Location</dt>
                            <dd class="col-8">{{ $event->location }}</dd>

                            <dt class="col-4">Volunteers Needed</dt>
                            <dd class="col-8">{{ $event->assignedUsers()->count() }} / {{ $event->num_of_needed_vol }}</dd>
                        </dl>

                        <div class="btn-row text-end">
                            <a href="{{ route('volunteers.assignedEvents') }}" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body card-info">
                <p class="p-5">map</p>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="title text-center">
                    <h4>Interested?</h4>
                </div>
                <p class="card-text">
                    We are looking for volunteers who are:
                    <ul>
                        <li>Enthusiastic</li>
                        <li>Reliable</li>
                        <li>Teamplayer</li>
                    </ul>
                </p>
                <div class="btn-row text-end">
                    <button class="btn btn-warning">Submit Feedback</button>
                </div>

                <form id="applyForm" action="{{ route('volunteers.submitApplication', $event->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="event_id" name="event_id" value="{{ $event->id }}">
                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" id="message" name="message" value="{{ Auth::user()->name }} has applied for Event {{ $event->title }}">
                    <input type="hidden" id="mod_id" name="mod_id" value="{{ $event->user_id }}">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
