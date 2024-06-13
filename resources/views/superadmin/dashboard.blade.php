@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="display-4">Welcome to the Super Admin Dashboard</h1>
</div>

<div class="container mt-4">
    <h2>Super Admin Dashboard</h2>
    <a href="{{ route('superadmin.createAdmin') }}" class="btn btn-primary mb-3">Create Admin</a>
    <h3>Users List</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        @if($admin->hasRole('admin'))
                            <span class="badge badge-success">Admin</span>
                        @elseif($admin->hasRole('user'))
                            <span class="badge badge-primary">User</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
