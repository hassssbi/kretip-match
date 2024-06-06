@extends('layouts.template')
@section('content')

<div class="card">
    <div class="card-body">
        <a href="{{ route('moderators.createEvent') }}" class="btn btn-success mb-2">Add New Event</a>
        <table id="example1" class="table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date From - To</th>
                    <th>Location</th>
                    <th>Vol Needed</th>
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
                            <td>
                                <form action="{{ route('moderators.deleteEvent', $e->id) }}" method="post">
                                    <a href="{{ route('moderators.viewEvent', $e->id) }}" class="btn btn-warning">
                                        <i class="fas fa-eye nav-icon"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    @if (Auth::user()->id == $e->user_id)
                                        <a href="{{ route('moderators.editEvent', $e->id) }}" class="btn btn-primary">
                                            <i class="fas fa-edit nav-icon"></i>
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-delete">
                                            <i class="fas fa-trash nav-icon"></i>
                                        </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">No data available</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script>
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
    </script>
@endpush

@endsection
