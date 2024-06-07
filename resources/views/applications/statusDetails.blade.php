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
                    <button class="btn btn-danger btn-cancel" {{ ($application->status === 'Rejected' || $application->status === 'Canceled') ? 'disabled' : '' }} >Cancel</button>
                </div>

                <form id="cancelForm" action="{{ route('volunteers.cancelApplication', $application->id) }}" method="POST" style="display: none;">
                    @csrf
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
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cancelForm').submit();
                }
            });
        });
    });
</script>

@endsection
