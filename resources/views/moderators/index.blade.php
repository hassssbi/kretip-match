@extends('layouts.template')
@section('content')

<style>
    i.fa.fa-star {
        color: #ffc107;
    }
</style>

<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="title text-center">
                            <h4>Notifications</h4>
                        </div>

                        @if ($applications->count() > 0)
                            @foreach ($applications as $application)
                                <div class="card">
                                    <div class="card-body">
                                        <div class="user-details">
                                            <div class="row">
                                                <div class="col">
                                                    <img src="{{ isset($application->user->image) ? Storage::url($application->user->image) : asset('admin/dist/img/default-user.png') }}" alt="" class="img-circle" style="height: 75px; width: 75px; border-radius: 50%">
                                                    <strong>{{ $application->user->name }}</strong>
                                                </div>
                                            </div>
                                            <p class="card-text py-2">
                                                {{  $application->status !== 'Canceled' ? $application->message : "Cancellation: {$application->message}" }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text">
                                        No notifications yet.
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Feedbacks</h4>
                        @if ($feedbacks->count() > 0)
                            @foreach ($feedbacks as $feedback)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="user-details">
                                            <div class="row rating">
                                                <div class="col">
                                                    <img src="{{ isset($feedback->user->image) ? Storage::url($feedback->user->image) : asset('admin/dist/img/default-user.png') }}" alt="" class="img-circle" style="height: 75px; width: 75px; border-radius: 50%">
                                                    <strong>{{ $feedback->user->name }}</strong>
                                                </div>
                                                <div class="col text-end">
                                                    @for ($i = 0; $i < $feedback->rating; $i++)
                                                        <i class="fa fa-star text-lg"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div class="feedback">
                                            <p class="card-text py-2">
                                                {{ $feedback->message }}
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text">
                                        No feedbacks for this event yet.
                                    </p>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
