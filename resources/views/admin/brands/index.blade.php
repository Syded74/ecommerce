@extends('layouts.app')

@section('title', 'Admin Brands')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-6">Brands</h1>
    <a href="{{ route('admin.brands.create') }}" class="bg-green-900 text-white px-4 py-2 rounded hover:bg-green-700 mb-4 inline-block">Add Brand</a>

    <div class="mb-4 flex space-x-2">
        <a href="{{ route('admin.brands.index', ['filter' => 'active']) }}" class="bg-green-900 text-white px-4 py-2 rounded hover:bg-green-700">Active</a>
        <a href="{{ route('admin.brands.index', ['filter' => 'inactive']) }}" class="bg-green-900  text-white px-4 py-2 rounded hover:bg-gray-700">Inactive</a>
        <a href="{{ route('admin.brands.index', ['filter' => 'deleted']) }}" class="bg-danger text-white px-4 py-2 rounded hover:bg-red-700">Deleted</a>
        <a href="{{ route('admin.brands.index', ['filter' => 'all']) }}" class="bg-green-900 text-white px-4 py-2 rounded hover:bg-gray-700">All</a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead class="bg-green-900 text-white">
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">ID</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">Name</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">Description</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($brands as $brand)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $brand->id }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $brand->name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $brand->description }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $brand->status }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="{{ route('admin.brands.show', $brand->id) }}" class="bg-green-900 text-white px-4 py-2 rounded hover:bg-blue-700">View</a>
                            @if($brand->trashed())
                                <form action="{{ route('admin.brands.restore', $brand->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-green-900 text-white px-4 py-2 rounded hover:bg-green-900">Restore</button>
                                </form>
                                <form action="{{ route('admin.brands.forceDelete', $brand->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Delete Permanently</button>
                                </form>
                            @else
                                <form action="{{ route('admin.brands.updateStatus', $brand->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="bg-gray-200 text-green-950 rounded-lg px-4 py-2">
                                        <option value="active" {{ $brand->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $brand->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </form>
                                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">No brands found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
