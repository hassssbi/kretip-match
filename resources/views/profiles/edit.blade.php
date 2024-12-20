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
        </div>

    </div>
    <div class="card-body p-5">
        <form action="{{ getRoleBasedRoute($user->role_id, 'updateProfile', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-12 border-bottom mb-2">
                <h4>User Details</h4>
            </div>
            <div class="form-group">
                <label for="name" class="input-label">Full Name</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="ALI BIN ABU">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="input-label">Email Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" placeholder="ali@example.com">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label for="phone_number" class="input-label">Phone Number</label>
                        <input type="tel" name="phone_number" id="phone_number" class="form-control" required autocomplete="phone_number" placeholder="0123456789" value="{{ $user->phone_number }}" >
                    </div>
                    <div class="col-6">
                        <label for="icno" class="input-label">MyKAD No.</label>
                        <input type="tel" name="icno" id="icno" class="form-control" required autocomplete="icno" placeholder="012345678901" value="{{ $user->icno }}" >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    @php
                        $genders = ['Male', 'Female'];
                    @endphp
                    <div class="col-6">
                        <label for="gender" class="input-label">Gender</label>
                        <select name="gender" id="gender" class="form-control select2bs4" required>
                            @foreach($genders as $gender)
                                <option value="{{ $gender }}" @if($user->gender == $gender) selected @endif>{{ $gender }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="dob" class="input-label">Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="form-control" required autocomplete="dob" value="{{ $user->dob }}" >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="input-label">Address</label>
                <input type="text" name="address" id="address" class="form-control" required autocomplete="address" placeholder="Address" value="{{ $user->address }}">
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label for="postcode" class="input-label">Postcode</label>
                        <input type="tel" name="postcode" id="postcode" class="form-control" required autocomplete="postcode" placeholder="XXXXX" value="{{ $user->postcode }}">
                    </div>
                    @php
                        $states = [
                            'Johor', 'Kedah', 'Kelantan', 'Melaka', 'Negeri Sembilan',
                            'Pahang', 'Pulau Pinang', 'Perak', 'Perlis', 'Selangor',
                            'Terengganu', 'Sabah', 'Sarawak', 'Wilayah Persekutuan'
                        ];
                    @endphp
                    <div class="col-6">
                        <label for="state" class="input-label">State</label>
                        <select name="state" id="state" class="form-control select2bs4" required autocomplete="state">
                            @foreach($states as $state)
                                <option value="{{ $state }}" @if($user->state == $state) selected @endif>{{ $state }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="about" class="input-label">About You</label>
                <textarea name="about" id="about" cols="30" rows="10" class="form-control" placeholder="Tell us a little about yourself..." style="resize: none">{{ $user->about }}</textarea>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="skills" class="input-label">Skills</label>
                        <div id="skills-container">
                            @if($user->skills)
                                <div class="input-group mb-3">
                                    <input type="text" name="skills[]" class="form-control" placeholder="Enter a skill">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success add-skill-btn">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                @foreach($user->skills as $skill)
                                    <div class="input-group mb-3">
                                        <input type="text" name="skills[]" class="form-control" value="{{ $skill->name }}" placeholder="Enter a skill">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger remove-skill-btn">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-3">
                                    <input type="text" name="skills[]" class="form-control" placeholder="Enter a skill">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success add-skill-btn">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="image" class="input-label">Profile Image</label>
                <input type="file" name="image" id="image" class="form-control col-6 @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <img id="image-preview" src="{{ (isset($user->image) ? Storage::url($user->image) : asset('admin/dist/img/default-user.png')) }}" alt="Image Preview" style="max-height: 200px; margin-top: 10px;">
            </div>

            <div class="btn-row text-end">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="reset" class="btn btn-default">Reset</button>
                <a href="{{ getRoleBasedRoute($user->role_id, 'profile', $user->id) }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('.add-skill-btn').addEventListener('click', function () {
            const skillInputGroup = document.createElement('div');
            skillInputGroup.classList.add('input-group', 'mb-3');

            const skillInput = document.createElement('input');
            skillInput.type = 'text';
            skillInput.name = 'skills[]';
            skillInput.classList.add('form-control');
            skillInput.placeholder = 'Enter a skill';

            const inputGroupAppend = document.createElement('div');
            inputGroupAppend.classList.add('input-group-append');

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.classList.add('btn', 'btn-danger', 'remove-skill-btn');
            removeButton.innerHTML = '<i class="fa fa-minus"></i>';
            removeButton.addEventListener('click', function () {
                skillInputGroup.remove();
            });

            inputGroupAppend.appendChild(removeButton);
            skillInputGroup.appendChild(skillInput);
            skillInputGroup.appendChild(inputGroupAppend);

            document.getElementById('skills-container').appendChild(skillInputGroup);
        });

        document.querySelectorAll('.remove-skill-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                this.closest('.input-group').remove();
            });
        });
    });

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('image-preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush

@endsection
