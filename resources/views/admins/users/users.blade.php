@extends('layouts.template')
@section('content')
<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>MyKAD No.</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($users->count() > 0)
                    @foreach ($users as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->icno }}</td>
                            <td>{{ $u->phone_number }}</td>
                            <td>
                                <div class="badge text-md {{ $u->role->id == 1 ? 'badge-warning' : ($u->role->id == 2 ? 'badge-success' : 'badge-info') }} ">{{ $u->role->name }}</div>
                            </td>
                            <td>
                                <form action="{{ route('admins.userDestroy', $u->id) }}" method="post">
                                    <a href="{{ route('admins.userProfile', $u->id) }}" class="btn btn-warning">
                                        <i class="fas fa-eye nav-icon"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    @if (Auth::user()->id != $u->id)
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
