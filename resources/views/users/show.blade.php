@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>User Details</h2>
        <table class="table">
            <tbody>
                <tr>
                    <th>Username</th>
                    <td>{{ $user->username }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ $user->role == 1 ? "Normal" : "Admin" }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $user->created_at->format('F d, Y H:i:s') }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $user->updated_at->format('F d, Y H:i:s') }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('profile.show') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
