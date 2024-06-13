@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Brands</h1>
    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Create Brand</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
