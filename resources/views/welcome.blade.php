@extends('layouts.app')

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div style="display:flex;flex-direction:row;justify-content:space-between;">
                            <h4>{{ __('You are logged in!') }}</h4>
                            <a href="{{ route('auth.logout') }}" class="btn btn-danger" style="margin-left: auto;">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
