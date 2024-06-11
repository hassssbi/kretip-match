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

                            <dt class="col-4">Skills</dt>
                            <dd class="col-8">
                                {{ $event->skills->implode('name', ', ') ?: 'No specific skills required.' }}
                            </dd>
                        </dl>

                        <div class="row justify-content-between">
                            <div class="col btn-row text-start">
                            </div>
                            <div class="col btn-row text-end d-inline">
                                @if (Auth::user()->id == $event->user_id && $event->status != 'Completed' )
                                    <form id="completeForm" class="d-inline-block" action="{{ route('moderators.completeEvent', $event->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-complete btn-success">Complete</button>
                                    </form>
                                    <a href="{{ route('moderators.editEvent', $event->id) }}" class="btn btn-primary d-inline-block">Edit</a>
                                    <form class="d-inline-block" action="{{ route('moderators.deleteEvent', $event->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                                    </form>
                                @endif
                                <a href="{{ route('moderators.events') }}" class="btn btn-default">Back</a>
                            </div>
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
                <input type="text" name="location" id="location" value="{{ $event->location }}" class="d-none">
                <input type="text" name="latitude" id="latitude" value="{{ $event->latitude }}" class="d-none">
                <input type="text" name="longitude" id="longitude" value="{{ $event->longitude }}" class="d-none">
                <div id="map" style="height: 300px; margin-top: 10px;"></div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="title text-center">
                    <h4>Number of Applications</h4>
                </div>
                <h2 class="text-center my-5">{{ isset($event->applications) ? $event->applications->count() : '0' }}</h2>
                <div class="btn-row text-end">
                    <a href="{{ route('moderators.applications', $event->id) }}" class="btn btn-warning">View Applications</a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize the map
            var loc_lat = document.getElementById('latitude').value;
            var loc_lng = document.getElementById('longitude').value;
            var map = L.map('map').setView([loc_lat, loc_lng], 13); // Set initial view to Kuala Lumpur
            var loc_marker = L.marker([loc_lat, loc_lng]).addTo(map);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);
        });

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        document.querySelector('.btn-complete').addEventListener('click', function () {
            event.preventDefault();
            const form = this.closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to complete this event?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, complete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
@endsection
