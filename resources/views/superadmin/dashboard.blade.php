@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="display-4">Welcome to the Super Admin Dashboard</h1>
</div>

<div class="container mt-4">
    <h2>Super Admin Dashboard</h2>
    <a href="{{ route('superadmin.createAdmin') }}" class="btn btn-primary mb-3">Create Admin</a>
    <h3>Users List</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        @if($admin->hasRole('admin'))
                            <span class="badge badge-success">Admin</span>
                        @elseif($admin->hasRole('user'))
                            <span class="badge badge-primary">User</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('superadmin.deleteAdmin', $admin->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
