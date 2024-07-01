@extends('layouts.template')
@section('content')

<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date From - To</th>
                    <th>Location</th>
                    <th>Vol Needed</th>
                    <th>Moderator</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($events->count() > 0)
                    @foreach ($events as $e)
                        <tr>
                            <td>{{ $e->id }}</td>
                            <td>{{ $e->title }}</td>
                            <td>{{ $e->start_date }} - {{ $e->end_date }}</td>
                            <td>{{ $e->location }}</td>
                            <td>{{ $e->assignedUsers()->count() }} / {{ $e->num_of_needed_vol }}</td>
                            <td>{{ $e->moderator->name }}</td>
                            <td>
                                <div class="badge text-md {{ ($e->status === 'Completed' ? 'badge-success' : ($e->status === 'Canceled' ? 'badge-danger' : 'badge-warning')) }}">{{ Str::upper($e->status)  }}</div>
                            </td>
                            <td>
                                <a href="{{ route('moderators.viewCompletedEvent', $e->id) }}" class="btn btn-warning">
                                    <i class="fas fa-eye nav-icon"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center">No data available</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection
