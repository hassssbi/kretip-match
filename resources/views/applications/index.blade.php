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
                                {{ $event->skills->implode('name', ', ') ?: 'No specific skills required.' }}
                            </dd>

                            <dt class="col-4">Moderator</dt>
                            <dd class="col-8">
                                {{ $event->moderator->name }}
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

{{-- <div class="row">
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
</div> --}}

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
                                <tr data-id="{{ $a->id }}" data-message="{{ $a->message }}" data-address="{{ $a->user->address }}" data-skills="{{ $a->user->skills->implode('name', ', ') ?: 'No skills.' }}" data-icno="{{ $a->user->icno }}" data-name="{{ $a->user->name }}" data-status="{{ $a->status }}" data-email="{{ $a->user->email }}" data-phone="{{ $a->user->phone_number }}">
                                    <td>{{ $a->id }}</td>
                                    <td>{{ $a->user->name }}</td>
                                    <td>
                                        <div class="badge text-md {{ ($a->status === 'Accepted' ? 'badge-success' : ($a->status === 'Rejected' || $a->status === 'Canceled' ? 'badge-danger' : 'badge-warning')) }}">{{ Str::upper($a->status)  }}</div>
                                    </td>
                                    <td>
                                        @if (Auth::user()->id == $a->event->user_id)
                                            <button class="btn-accept btn btn-success" {{ ($a->status !== 'Accepted' && $a->status !== 'Rejected' && $a->status !== 'Canceled') ? '' : 'disabled' }} >Accept</button>
                                            <button class="btn-reject btn btn-danger" {{ ($a->status !== 'Accepted' && $a->status !== 'Rejected' && $a->status !== 'Canceled') ? '' : 'disabled' }}>Reject</button>
                                            <button class="btn-blacklist btn btn-warning" {{ ($a->user->isBlacklisted() ? 'disabled' : '') }}>Blacklist</button>
                                        @endif

                                        <!-- Invisible forms for accepting and rejecting applications -->
                                        <form method="POST" action="{{ route('moderators.applicationsAccept', $a->id) }}" class="d-none form-accept">
                                            @csrf
                                        </form>
                                        <form method="POST" action="{{ route('moderators.applicationsReject', $a->id) }}" class="d-none form-reject">
                                            @csrf
                                        </form>
                                        <form method="POST" action="{{ route('moderators.blacklistUser', $a->user->id) }}" class="d-none form-blacklist">
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

        document.querySelectorAll('.btn-blacklist').forEach(button => {
            button.addEventListener('click', function () {
                let form = this.closest('tr').querySelector('.form-blacklist');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to blacklist this user?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, blacklist it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        document.querySelectorAll('table#example1 tbody tr').forEach(row => {
            row.addEventListener('click', function (e) {
                // Avoid triggering the row click event when clicking on buttons
                if (e.target.tagName === 'BUTTON') return;

                let id = this.getAttribute('data-id');
                let name = this.getAttribute('data-name');
                let status = this.getAttribute('data-status');
                let email = this.getAttribute('data-email');
                let phone = this.getAttribute('data-phone');
                let icno = this.getAttribute('data-icno');
                let skills = this.getAttribute('data-skills');
                let address = this.getAttribute('data-address');
                let message = this.getAttribute('data-message');

                if(status == 'Canceled') {
                    Swal.fire({
                        title: name,
                        html: `
                            <dl class="row">
                                <dt class="col-4 text-right">MyKAD No.</dt>
                                <dd class="col-6 text-left">${icno}</dd>
                                <dt class="col-4 text-right">Address</dt>
                                <dd class="col-6 text-left">${address}</dd>
                                <dt class="col-4 text-right">Phone</dt>
                                <dd class="col-6 text-left">${phone}</dd>
                                <dt class="col-4 text-right">Email</dt>
                                <dd class="col-6 text-left">${email}</dd>
                                <dt class="col-4 text-right">Skills</dt>
                                <dd class="col-6 text-left">${skills}</dd>
                                <dt class="col-4 text-right">Reason for Cancellation</dt>
                                <dd class="col-6 text-left">${message}</dd>
                            </dl>
                        `,

                        icon: 'info',
                        confirmButtonText: 'Close'
                    });
                } else {
                    Swal.fire({
                        title: name,
                        html: `
                            <dl class="row">
                                <dt class="col-4 text-right">MyKAD No.</dt>
                                <dd class="col-6 text-left">${icno}</dd>
                                <dt class="col-4 text-right">Address</dt>
                                <dd class="col-6 text-left">${address}</dd>
                                <dt class="col-4 text-right">Phone</dt>
                                <dd class="col-6 text-left">${phone}</dd>
                                <dt class="col-4 text-right">Email</dt>
                                <dd class="col-6 text-left">${email}</dd>
                                <dt class="col-4 text-right">Skills</dt>
                                <dd class="col-6 text-left">${skills}</dd>
                            </dl>
                        `,

                        icon: 'info',
                        confirmButtonText: 'Close'
                    });
                }
            });
        });
    });
</script>



@endsection
