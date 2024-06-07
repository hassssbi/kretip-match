@extends('layouts.template')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-6">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="title">
                            <h4>Announcements</h4>
                        </div>

                        @if ($announcements->count() > 0)
                            @foreach ($announcements as $announcement)
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h5>{{ $announcement->title }}</h5>
                                        </div>
                                        <p class="card-text">
                                            {{ $announcement->description }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text">
                                        No announcements for now.
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="title">
                            <h4>Events</h4>
                        </div>
                        <h5 class="py-5">
                            {{ $events->count() }} new events posted!
                        </h5>
                        <div class="btn-row text-center">
                            <a href="{{ route('volunteers.events') }}" class="btn btn-warning">View Events</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
