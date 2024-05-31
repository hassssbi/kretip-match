@extends('layouts.template')
@section('content')

<div class="card card-widget widget-user-2">
    <div class="widget-user-header bg-warning p-4">
        <div class="row justify-content-between">
            <div class="col-6">
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="{{ asset('admin/dist/img/fsjal.png') }}" alt="User Avatar">
                </div>
                <h3 class="widget-user-username">{{ $user->name }}</h3>
                <h5 class="widget-user-desc">{{ $user->role->name }}</h5>
            </div>
        </div>

    </div>
    <div class="card-body p-5">
        <form action="{{ getRoleBasedRoute($user->role_id, 'savePassword', $user->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="col-12 border-bottom my-2">
                <h4>Change Password</h4>
            </div>
            <div class="form-group">
                <label for="password" class="input-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="********">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm" class="input-label">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="********">
            </div>

            <div class="btn-row float-right">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="reset" class="btn btn-default">Reset</button>
                <a href="{{ getRoleBasedRoute($user->role_id, 'profile', $user->id) }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
