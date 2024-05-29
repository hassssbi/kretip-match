@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card p-3">
                <div class="card-title">
                    <h2 class="text-center">Registration</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="input-label">Full Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="ALI BIN ABU">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="input-label">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="ali@example.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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

                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="phone_number" class="input-label">Phone Number</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control" required autocomplete="phone_number" placeholder="0123456789">
                                </div>
                                <div class="col-6">
                                    <label for="icno" class="input-label">MyKAD No.</label>
                                    <input type="text" name="icno" id="icno" class="form-control" required autocomplete="icno" placeholder="012345-67-8901">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="gender" class="input-label">Gender</label>
                                    <select name="gender" id="gender" class="form-control select2bs4" required>
                                        <option value="M" selected>Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="dob" class="input-label">Date of Birth</label>
                                    <input type="date" name="dob" id="dob" class="form-control" required autocomplete="dob">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="input-label">Address</label>
                            <input type="text" name="address" id="address" class="form-control" required autocomplete="address" placeholder="Address">
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="postcode" class="input-label">Postcode</label>
                                    <input type="text" name="postcode" id="postcode" class="form-control" required autocomplete="postcode" placeholder="XXXXX">
                                </div>
                                <div class="col-6">
                                    <label for="state" class="input-label">State</label>
                                    <select name="state" id="state" class="form-control select2bs4" required autocomplete="state">
                                        <option value="Johor">Johor</option>
                                        <option value="Kedah">Kedah</option>
                                        <option value="Kelantan">Kelantan</option>
                                        <option value="Melaka">Melaka</option>
                                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                                        <option value="Pahang">Pahang</option>
                                        <option value="Pulau Pinang">Pulau Pinang</option>
                                        <option value="Perak">Perak</option>
                                        <option value="Perlis">Perlis</option>
                                        <option value="Selangor">Selangor</option>
                                        <option value="Terengganu">Terengganu</option>
                                        <option value="Sabah">Sabah</option>
                                        <option value="Sarawak">Sarawak</option>
                                        <option value="Wilayah Persekutuan">Wilayah Persekutuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="about" class="input-label">About You</label>
                            <textarea name="about" id="about" cols="30" rows="10" class="form-control" placeholder="Tell us a little about yourself..." style="resize: none"></textarea>
                        </div>

                        <div class="btn- float-right">
                            <button type="submit" class="btn btn-primary">Register</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
