@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="card">
        <div class="card-header">
            Profile
        </div>
        <div class="card-body">
            <div class="text-center mb-3">
                @if($user->profile_picture)
                    <img src="{{ asset('profile_pictures/' . $user->profile_picture) }}" alt="Profile Picture" class="img-thumbnail" style="width: 150px; height: 150px;">
                @else
                    <img src="{{ asset('images/default_profile.png') }}" alt="Default Profile Picture" class="img-thumbnail" style="width: 150px; height: 150px;">
                @endif
            </div>
            <p><strong>Username:</strong> {{ $user->username }}</p>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            <form action="{{ route('profile.destroy') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Delete Profile</button>
            </form>
        </div>
    </div>
@endsection
