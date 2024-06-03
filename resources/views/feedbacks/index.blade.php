@extends('layouts.template')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="title">
                    <h4>Feedbacks</h4>
                </div>
                <p class="card-text">Event</p>
                <div class="btn-row text-end">
                    <a href="{{ route('moderators.viewCompletedEvent', $event->id) }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <p class="card-text">
                    rating and stars
                </p>
            </div>
        </div>
    </div>

    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <p class="card-text">
                    feedbacks lists
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
