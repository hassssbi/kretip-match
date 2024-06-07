@extends('layouts.template')
@section('content')
<div class="card card-widget widget-user-2">
    <div class="widget-user-header bg-warning p-4">
        <div class="row justify-content-between">
            <div class="col-6">
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="{{ Request::routeIs('admins.profile') || Request::routeIs('admins.editProfile') || Request::routeIs('admins.changePassword') || Request::routeIs('moderators.profile') || Request::routeIs('moderators.editProfile') || Request::routeIs('moderators.changePassword') || Request::routeIs('volunteers.profile') || Request::routeIs('volunteers.editProfile') || Request::routeIs('volunteers.changePassword') ? (isset(Auth::user()->image) ? Storage::url(Auth::user()->image) : asset('admin/dist/img/default-user.png')) : (isset($user->image) ? Storage::url($user->image) : asset('admin/dist/img/default-user.png')) }}" alt="User Avatar">
                </div>
                <h3 class="widget-user-username">{{ $user->name }}</h3>
                <h5 class="widget-user-desc">{{ $user->role->name }}</h5>
            </div>
            <div class="col-6 text-end">
                @if (Request::routeIs('admins.profile') || Request::routeIs('moderators.profile') || Request::routeIs('volunteers.profile'))
                    <a href="{{ getRoleBasedRoute($user->role_id, 'editProfile', $user->id) }}" class="btn btn-primary">Edit Profile</a>
                    <a href="{{ getRoleBasedRoute($user->role_id, 'changePassword', $user->id) }}" class="btn btn-primary">Change Password</a>
                @elseif (Request::routeIs('admins.userProfile') && Auth::user()->id != $user->id)
                    <button id="updateRoleBtn" class="btn btn-primary">Update Role</button>
                @endif
            </div>
        </div>

    </div>
    <div class="card-body p-5">
        <div class="row">
            <div class="col-12 border-bottom mb-2">
                <h4>User Details</h4>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="" class="input-label">Full Name</label>
                    <input class="form-control-plaintext" readonly type="text" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="" class="input-label">Email</label>
                    <input class="form-control-plaintext" readonly type="text" value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="" class="input-label">Phone Number</label>
                    <input class="form-control-plaintext" readonly type="text" value="{{ $user->phone_number }}">
                </div>
                <div class="form-group">
                    <label for="" class="input-label">MyKAD No.</label>
                    <input class="form-control-plaintext" readonly type="text" value="{{ $user->icno }}">
                </div>
                <div class="form-group">
                    <label for="" class="input-label">Gender</label>
                    <input class="form-control-plaintext" readonly type="text" value="{{ $user->gender }}">
                </div>
                <div class="form-group">
                    <label for="" class="input-label">Skills</label>
                    <textarea readonly name="" id="" class="form-control-plaintext" style="resize: none">{{ $skills ?: 'No skills.' }}</textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="" class="input-label">Date of Birth</label>
                    <input class="form-control-plaintext" readonly type="text" value="{{ $user->dob }}">
                </div>
                <div class="form-group">
                    <label for="" class="input-label">Address</label>
                    <textarea readonly name="" id="" class="form-control-plaintext" style="resize: none">{{ $user->address }}</textarea>
                </div>
                <div class="form-group">
                    <label for="" class="input-label">Postcode</label>
                    <input class="form-control-plaintext" readonly type="text" value="{{ $user->postcode }}">
                </div>
                <div class="form-group">
                    <label for="" class="input-label">State</label>
                    <input class="form-control-plaintext" readonly type="text" value="{{ $user->state }}">
                </div>
                <div class="form-group">
                    <label for="" class="input-label">About You</label>
                    <textarea readonly name="" id="" class="form-control-plaintext" style="resize: none">{{ $user->about }}</textarea>
                </div>
            </div>
        </div>
        @if (Request::routeIs('admins.profile') || Request::routeIs('moderators.profile') || Request::routeIs('volunteers.profile'))
            <a href="{{ getRoleBasedRoute($user->role_id, 'index', $user->id) }}" class="btn btn-default float-right">Back</a>
        @elseif (Request::routeIs('admins.userProfile'))
            <a href="{{ route('admins.users') }}" class="btn btn-default float-right">Back</a>
        @endif
    </div>
</div>

@push('scripts')
@if (Request::routeIs('admins.userProfile'))
    <script>
        document.getElementById('updateRoleBtn').addEventListener('click', function(event) {
            event.preventDefault();

            const roles = @json($roles);
            const currentRoleId = {{ $user->role_id }};

            let options = '';
            roles.forEach(role => {
                const selected = role.id === currentRoleId ? 'selected' : '';
                options += `<option value="${role.id}" ${selected}>${role.name}</option>`;
            });

            Swal.fire({
                title: 'Update Role',
                html: `
                    <form id="updateRoleForm" action="{{ route('admins.updateUserRole', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="d-flex justify-content-center">
                            <select name="role_id" id="role_id" class="form-select col-6">
                                ${options}
                            </select>
                        </div>
                    </form>
                `,
                focusConfirm: false,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Update',
                preConfirm: () => {
                    document.getElementById('updateRoleForm').submit();
                }
            });
        });
    </script>
@endif
@endpush

@endsection
