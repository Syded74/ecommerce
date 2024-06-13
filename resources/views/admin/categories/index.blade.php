@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create Category</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
