@extends('layouts.app')

@section('title', 'Admin Categories')

@section('content')

        <div class="col-span-3">
            <h1 class="text-2xl font-semibold mb-6">Categories</h1>
            <a href="{{ route('admin.categories.create') }}" class="bg-green-900 text-white px-4 py-2 rounded hover:bg-green-500 mb-4 inline-block">Add Category</a>

            <div class="mb-4">
                <a href="{{ route('admin.categories.index', ['filter' => 'active']) }}" class="bg-green-900 text-white px-4 py-2 rounded hover:bg-green-700">Active</a>
                <a href="{{ route('admin.categories.index', ['filter' => 'inactive']) }}" class="bg-green-900 text-white px-4 py-2 rounded hover:bg-green-700">Inactive</a>
                <a href="{{ route('admin.categories.index', ['filter' => 'deleted']) }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Deleted</a>
                <a href="{{ route('admin.categories.index', ['filter' => 'all']) }}" class="bg-green-900 text-white px-4 py-2 rounded hover:bg-secondary-dark">All</a>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full bg-white">
                    <thead class="bg-green-800 text-white">
                        <tr>
                            <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">ID</th>
                            <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Name</th>
                            <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Status</th>
                            <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse ($categories as $category)
                            <tr>
                                <td class="w-1/6 py-3 px-4">{{ $category->id }}</td>
                                <td class="w-1/3 py-3 px-4">{{ $category->name }}</td>
                                <td class="w-1/6 py-3 px-4">{{ $category->status }}</td>
                                <td class="w-1/3 py-3 px-4 flex space-x-2">
                                    @if($category->trashed())
                                        <form action="{{ route('admin.categories.restore', $category->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-green-900 text-white px-4 py-2 rounded hover:bg-green-700">Restore</button>
                                        </form>
                                        <form action="{{ route('admin.categories.forceDelete', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Delete Permanently</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.categories.updateStatus', $category->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-select bg-gray-200 rounded" onchange="this.form.submit()">
                                                <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </form>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
