@extends('template')

@section('title', 'Edit Profile')

@section('content')
    @include('navbar')
    <div class="container mt-5">
        @if (isset($errors))
            @foreach ($errors as $item)
                {{$item}}
            @endforeach
        @endif
        <h1>Edit Profile</h1>
        <form method="POST" action="/edit-profile" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="file" class="form-control visually-hidden" id="profile_picture" name="profile_picture" onchange="displayImage(this)">
                <label for="profile_picture" class="profile-picture">
                    <img src="{{ asset($profile_picture) }}" class="rounded-circle" alt="Profile Picture" width="200" height="200">
                </label>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}" disabled>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" disabled>
            </div>
            <div class="mb-3">
                <label for="old_password" class="form-label">Old Password</label>
                <input type="password" class="form-control" id="old_password" name="old_password">
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" value="{{ Auth::user()->dob }}">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

    <script>
        function displayImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(input).next().find('img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
