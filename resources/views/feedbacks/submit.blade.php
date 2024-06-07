@extends('layouts.template')
@section('content')
<style>
    span.star.fa.fa-star {
        color: #ffc700
    }

</style>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8 my-auto">
                <div class="row">
                    <div class="col-4">
                        <div class="d-flex justify-content-center">
                            <img src="{{ Storage::url($event->poster) }}" alt="" style="height: 200px; width: 160px">
                        </div>
                    </div>
                    <div class="col-8 my-auto">
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
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('volunteers.storeFeedback', $event->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="input-label">Name</label>
                                <input type="text" readonly name="name" id="name" class="form-control" value="{{ auth()->user()->name }}">
                            </div>

                            <div class="form-group">
                                <label for="email" class="input-label">Email</label>
                                <input type="email" readonly name="email" id="email" class="form-control" value="{{ auth()->user()->email }}">
                            </div>

                            <div class="form-group">
                                <label for="rating" class="input-label">Rating</label>
                                <input id="rating" name="rating" type="range" min="1" max="5" step="1" class="form-range" value="0">
                                <div class="star-rating d-flex justify-content-between">
                                    <span class="star fa fa-star" data-value="1"></span>
                                    <span class="star fa fa-star" data-value="2"></span>
                                    <span class="star fa fa-star" data-value="3"></span>
                                    <span class="star fa fa-star" data-value="4"></span>
                                    <span class="star fa fa-star" data-value="5"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="message" class="input-label">Message</label>
                                <textarea name="message" id="message" cols="30" rows="10" class="form-control" style="resize: none" placeholder="How do you feel about the event?"></textarea>
                            </div>

                            <div class="btn-row text-end">
                                <a href="{{ route('volunteers.assignedEventsDetails', $event->id) }}" class="btn btn-default">Back</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
    <style>
        .star-rating {
            display: inline-block;
            font-size: 2rem;
            color: #ddd;
        }
        .star-rating .star {
            cursor: pointer;
            transition: color 0.2s;
        }
        .star-rating .star.selected {
            color: #ffc700;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#rating').on('input', function() {
                let ratingValue = $(this).val();
                $('.star-rating .star').each(function() {
                    let starValue = $(this).data('value');
                    if (starValue <= ratingValue) {
                        $(this).addClass('selected');
                    } else {
                        $(this).removeClass('selected');
                    }
                });
            });

            $('.star-rating .star').on('click', function() {
                let selectedValue = $(this).data('value');
                $('#rating').val(selectedValue).trigger('input');
            });
        });
    </script>
@endsection
