@extends('layouts.app')

@section('title', 'Admin Users')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-4 gap-4">
        <div class="col-span-3">
            <h1 class="text-2xl font-semibold mb-6">Users</h1>
            <a href="{{ route('admin.users.create') }}" class="bg-primary text-white px-4 py-2 rounded hover:bg-green-700 mb-4 inline-block">Add User</a>

            <div class="mb-4">
                <a href="{{ route('admin.users.index', ['filter' => 'active']) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Active</a>
                <a href="{{ route('admin.users.index', ['filter' => 'inactive']) }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Inactive</a>
                <a href="{{ route('admin.users.index', ['filter' => 'deleted']) }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Deleted</a>
                <a href="{{ route('admin.users.index', ['filter' => 'all']) }}" class="bg-secondary text-white px-4 py-2 rounded hover:bg-secondary-dark">All</a>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">ID</th>
                            <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Name</th>
                            <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Email</th>
                            <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Status</th>
                            <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse ($users as $user)
                            <tr>
                                <td class="w-1/6 py-3 px-4">{{ $user->id }}</td>
                                <td class="w-1/3 py-3 px-4">{{ $user->name }}</td>
                                <td class="w-1/3 py-3 px-4">{{ $user->email }}</td>
                                <td class="w-1/6 py-3 px-4">{{ $user->status }}</td>
                                <td class="w-1/3 py-3 px-4 flex space-x-2">
                                    @if($user->trashed())
                                        <form action="{{ route('admin.users.restore', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Restore</button>
                                        </form>
                                        <form action="{{ route('admin.users.forceDelete', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Delete Permanently</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-select bg-gray-200 rounded" onchange="this.form.submit()">
                                                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </form>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
