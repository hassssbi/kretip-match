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
                                @if(!empty($eventSkills))
                                    {{ $eventSkills }}
                                @else
                                    No specific skills required.
                                @endif
                            </dd>
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
                                    <td>{{ $a->user->name }}</td>
                                    <td>
                                        <div class="badge text-md {{ ($a->status === 'Accepted' ? 'badge-success' : ($a->status === 'Rejected' || $a->status === 'Canceled' ? 'badge-danger' : 'badge-warning')) }}">{{ Str::upper($a->status)  }}</div>
                                    </td>
                                    <td>
                                        <button class="btn-accept btn btn-success" {{ ($a->status !== 'Accepted' && $a->status !== 'Rejected') ? '' : 'disabled' }} >Accept</button>
                                        <button class="btn-reject btn btn-danger" {{ ($a->status !== 'Accepted' && $a->status !== 'Rejected') ? '' : 'disabled' }}>Reject</button>
                                        <!-- Invisible forms for accepting and rejecting applications -->
                                        <form method="POST" action="{{ route('moderators.applicationsAccept', $a->id) }}" class="d-none form-accept">
                                            @csrf
                                        </form>
                                        <form method="POST" action="{{ route('moderators.applicationsReject', $a->id) }}" class="d-none form-reject">
                                            @csrf
                                        </form>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-accept').forEach(button => {
            button.addEventListener('click', function () {
                let form = this.closest('tr').querySelector('.form-accept');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to accept this application?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, accept it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        document.querySelectorAll('.btn-reject').forEach(button => {
            button.addEventListener('click', function () {
                let form = this.closest('tr').querySelector('.form-reject');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to reject this application?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reject it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

@endsection
