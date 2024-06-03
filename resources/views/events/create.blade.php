@extends('layouts.template')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-8">

                    <div class="col-12 border-bottom mb-2">
                        <h3>Event Details</h3>
                    </div>

                    <form action="{{ route('moderators.storeEvent', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="title" class="input-label">Title</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus placeholder="EG: Buskernita Competition">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description" class="input-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Give a little description about the event..." style="resize: none"></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="num_of_needed_vol" class="input-label">Volunteers Needed</label>
                                    <input id="num_of_needed_vol" type="number" class="form-control @error('num_of_needed_vol') is-invalid @enderror" name="num_of_needed_vol" value="0" min="0" required autocomplete="num_of_needed_vol">
                                    @error('num_of_needed_vol')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="start_date" class="input-label">Start Date</label>
                                    <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" required autocomplete="start_date">
                                    @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="end_date" class="input-label">End Date</label>
                                    <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" required autocomplete="end_date">
                                    @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="start_time" class="input-label">Start Time</label>
                                    <input id="start_time" type="time" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="08:00" required autocomplete="start_time">
                                    @error('start_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="end_time" class="input-label">End Time</label>
                                    <input id="end_time" type="time" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="10:00" required autocomplete="end_time">
                                    @error('end_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location" class="input-label">Location</label>
                            <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location" autofocus placeholder="Kuala Lumpur">
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="poster" class="input-label">Poster</label>
                            <input type="file" name="poster" id="poster" class="form-control @error('poster') is-invalid @enderror">
                            @error('poster')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="btn-row text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <a href="{{ route('moderators.events') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
document.getElementById('start_date').valueAsDate = new Date();
document.getElementById('end_date').valueAsDate = new Date();
</script>
@endpush
@endsection