@extends('layouts.app')

@section('title', 'Profile')

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> <i class="fa-solid fa-address-card"></i>{{ __(' Profile') }}</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <p> <i class="fa-solid fa-user"></i> <strong> Username:</strong> {{ $user->username }}</p>
                        <p> <i class="fa-solid fa-cart-shopping"> </i><strong> Purchases:</strong> {{ $user->purchases }}</p>
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                        <form action="{{ route('profile.destroy') }}" method="POST" class="d-inline-block">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
