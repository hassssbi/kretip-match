@extends('layouts.template')
@section('content')

<style>
    i.fa.fa-star {
        color: #ffc107;
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
                        @for ($i = 0; $i < $feedbacks->average('rating'); $i++)
                            <i class="fa fa-star text-lg"></i>
                        @endfor
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
                <div class="row">
                    <div class="col-1">
                        <label for="5_star" class="input-label">5</label>
                    </div>
                    <div class="col-9">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $total > 0 ? ($count5 / $total) * 100 : 0 }}%" aria-valuenow="{{ $count5 }}" aria-valuemin="0" aria-valuemax="{{ $total }}"></div>
                        </div>
                    </div>
                    <div class="col-2 text-end">
                        <p>{{ $count5 }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <label for="4_star" class="input-label">4</label>
                    </div>
                    <div class="col-9">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $total > 0 ? ($count4 / $total) * 100 : 0 }}%" aria-valuenow="{{ $count4 }}" aria-valuemin="0" aria-valuemax="{{ $total }}"></div>
                        </div>
                    </div>
                    <div class="col-2 text-end">
                        <p>{{ $count4 }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <label for="3_star" class="input-label">3</label>
                    </div>
                    <div class="col-9">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $total > 0 ? ($count3 / $total) * 100 : 0 }}%" aria-valuenow="{{ $count3 }}" aria-valuemin="0" aria-valuemax="{{ $total }}"></div>
                        </div>
                    </div>
                    <div class="col-2 text-end">
                        <p>{{ $count3 }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <label for="2_star" class="input-label">2</label>
                    </div>
                    <div class="col-9">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $total > 0 ? ($count2 / $total) * 100 : 0 }}%" aria-valuenow="{{ $count2 }}" aria-valuemin="0" aria-valuemax="{{ $total }}"></div>
                        </div>
                    </div>
                    <div class="col-2 text-end">
                        <p>{{ $count2 }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <label for="1_star" class="input-label">1</label>
                    </div>
                    <div class="col-9">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $total > 0 ? ($count1 / $total) * 100 : 0 }}%" aria-valuenow="{{ $count1 }}" aria-valuemin="0" aria-valuemax="{{ $total }}"></div>
                        </div>
                    </div>
                    <div class="col-2 text-end">
                        <p>{{ $count1 }}</p>
                    </div>
                </div>
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
