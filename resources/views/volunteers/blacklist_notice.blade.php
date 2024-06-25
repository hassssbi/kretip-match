@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-12 justify-content-center">
        <div class="card p-5">
            <div class="card-body text-center">
                <h3>You are currently blacklisted</h3>
                <p>You are not allowed to apply for any events until {{ auth()->user()->blacklist_end_date }}.</p>

                <a href="{{ route('volunteers.index') }}" class="btn btn-warning mt-2" role="button">Home</a>
            </div>
        </div>
    </div>
</div>
@endsection
