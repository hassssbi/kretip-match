@extends('layouts.template')
@section('content')

    <div class="row">
        <div class="col-12 justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ Storage::url($event->poster) }}" alt="Event Poster" style="height: 200px">
                        </div>
                        <div class="col-8">
                            <dl class="row">
                                <dt class="col-3">Event Title</dt>
                                <dd class="col-9">{{ $event->title }}</dd>

                                <dt class="col-3">Description</dt>
                                <dd class="col-9">{{ $event->description }}</dd>

                                <dt class="col-3">Date</dt>
                                <dd class="col-9">{{ $event->start_date }} to {{ $event->end_date }}</dd>

                                <dt class="col-3">Location</dt>
                                <dd class="col-9">{{ $event->location }}</dd>

                                <dt class="col-3">Volunteers Needed</dt>
                                <dd class="col-9">{{ $event->num_of_needed_vol }}</dd>
                            </dl>
                        </div>
                        <div class="btn-row text-end">
                            <a href="{{ route('moderators.viewEvent', $event->id) }}" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Volunteer</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($applications->count() > 0)
                                @foreach ($applications as $a)
                                    <tr>
                                        <td>{{ $a->id }}</td>
                                        <td>{{ $a->user_id }}</td>
                                        <td>{{ $a->status }}</td>
                                        <td>
                                            <a href="" class="btn btn-success">Accept</a>
                                            <a href="" class="btn btn-danger">Reject</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No data available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
