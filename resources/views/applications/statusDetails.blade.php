@extends('layouts.template')
@section('content')

<div class="row">
    <div class="col-12 justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <img src="{{ Storage::url($application->event->poster) }}" alt="" style="height: 200px">
                    </div>
                    <div class="col-8">
                        <dl class="row">
                            <dt class="col-4">Event Title</dt>
                            <dd class="col-8">{{ $application->event->title }}</dd>

                            <dt class="col-4">Description</dt>
                            <dd class="col-8">{{ $application->event->description }}</dd>

                            <dt class="col-4">Date</dt>
                            <dd class="col-8">{{ $application->event->start_date }} to {{ $application->event->end_date }}</dd>

                            <dt class="col-4">Location</dt>
                            <dd class="col-8">{{ $application->event->location }}</dd>

                            <dt class="col-4">Volunteers Needed</dt>
                            <dd class="col-8">{{ $application->event->assignedUsers()->count() }} / {{ $application->event->num_of_needed_vol }}</dd>

                            <dt class="col-4">Skills</dt>
                            <dd class="col-8">
                                {{ $application->event->skills->implode('name', ', ') ?: 'No specific skills required.' }}
                            </dd>

                            <dt class="col-4">Moderator</dt>
                            <dd class="col-8">
                                {{ $application->event->moderator->name }}
                            </dd>
                        </dl>

                        <div class="btn-row text-end">
                            <a href="{{ route('volunteers.status') }}" class="btn btn-default">Back</a>
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
                <input type="text" name="location" id="location" value="{{ $application->event->location }}" class="d-none">
                <input type="text" name="latitude" id="latitude" value="{{ $application->event->latitude }}" class="d-none">
                <input type="text" name="longitude" id="longitude" value="{{ $application->event->longitude }}" class="d-none">
                <div id="map" style="height: 300px; margin-top: 10px;"></div>
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
                    <button class="btn btn-danger btn-cancel" {{ ($application->status === 'Rejected' || $application->status === 'Canceled' || $application->event->isCompleted()) ? 'disabled' : '' }} >Cancel</button>
                </div>

                <form id="cancelForm" action="{{ route('volunteers.cancelApplication', $application->id) }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="reason" id="cancelReason">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('.btn-cancel').addEventListener('click', function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to cancel your application?",
                icon: 'warning',
                input: 'textarea',
                inputPlaceholder: 'Enter your reason for cancellation...',
                inputAttributes: {
                    'aria-label': 'Enter your reason for cancellation',
                    'style': 'resize: none'
                },
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!',
                preConfirm: (reason) => {
                    if (!reason) {
                        Swal.showValidationMessage('Reason is required');
                        return false;
                    }
                    document.getElementById('cancelReason').value = reason;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cancelForm').submit();
                }
            });
        });

        // Initialize the map
        var loc_lat = document.getElementById('latitude').value;
        var loc_lng = document.getElementById('longitude').value;
        var map = L.map('map').setView([loc_lat, loc_lng], 13); // Set initial view to Kuala Lumpur
        var loc_marker = L.marker([loc_lat, loc_lng]).addTo(map);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);
    });
</script>

@endsection
