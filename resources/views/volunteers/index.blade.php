@extends('layouts.template')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="title">
                                    <h4>Notifications</h4>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        noti
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        noti
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        noti
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="title">
                                    <h4>Events</h4>
                                </div>
                                <p class="card-text">
                                    $count new events posted!
                                </p>
                                <div class="btn-row text-center">
                                    <a href="{{ route('volunteers.events') }}" class="btn btn-warning">View Events</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
