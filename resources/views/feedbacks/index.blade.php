@extends('layouts.template')
@section('content')

<style>
    i.fa.fa-star, i.fa.fa-star-half.halfStar {
        color: #ffc107;
    }

    i.fa.fa-star.emptyStar {
        color: #c0c0c0
    }
    .progress {
        height: 20px;
        background-color: #e9ecef;
        border-radius: 30px
    }
    .progress-bar {
        background-color: #ffc107;
        border-radius: 30px
    }
</style>

<div class="row">
    <div class="col-12 justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <img src="{{ Storage::url($event->poster) }}" alt="" style="height: 200px">
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

                        <div class="btn-row text-end">
                            <a href="{{ route('moderators.completedEvents') }}" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
<!-- Reviews Section -->
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <p class="text-sm">Reviews</p>
                <div class="row">
                    <h2 class="rating">
                        {{ number_format($feedbacks->average('rating'), 1) }}
                    </h2>
                </div>
                <div class="row">
                    <div class="col">
                        @php
                            $averageRating = $feedbacks->average('rating');
                            $fullStars = floor($averageRating);
                            $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                            $emptyStars = 5 - ($fullStars + $halfStar);
                        @endphp

                        @for ($i = 0; $i < $fullStars; $i++)
                            <i class="fa fa-star text-lg"></i>
                        @endfor

                        @if ($halfStar)
                            <i class="halfStar fa fa-star-half text-lg"></i>
                        @endif

                        {{-- @for ($i = 0; $i < $emptyStars; $i++)
                            <i class="emptyStar fa fa-star text-lg"></i>
                        @endfor --}}
                    </div>
                    <div class="description">
                        <p class="">({{ $feedbacks->count() }} Reviews)</p>
                    </div>
                </div>

                @php
                    $count5 = $feedbacks->where('rating', 5)->count();
                    $count4 = $feedbacks->where('rating', 4)->count();
                    $count3 = $feedbacks->where('rating', 3)->count();
                    $count2 = $feedbacks->where('rating', 2)->count();
                    $count1 = $feedbacks->where('rating', 1)->count();
                    $total = $feedbacks->count();
                @endphp

                <!-- Rating Distribution -->
                @foreach ([5, 4, 3, 2, 1] as $rating)
                    @php
                        $countVar = 'count' . $rating;
                        $count = $$countVar;
                        $percentage = $total > 0 ? ($count / $total) * 100 : 0;
                    @endphp
                    <div class="row">
                        <div class="col-2">
                            <label class="input-label">{{ $rating }}<i class="ml-2 fa fa-star text-lg"></i></label>
                        </div>
                        <div class="col-8">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $count }}" aria-valuemin="0" aria-valuemax="{{ $total }}"></div>
                            </div>
                        </div>
                        <div class="col-2 text-end">
                            <p>{{ $count }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-8">
        <div class="card">
            <div class="card-body">
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

@endsection
