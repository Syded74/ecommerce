@extends('layouts.app')

@section('title', 'Brand Details')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $brand->name }}</h1>
            <p>{{ $brand->description }}</p>
            <p>Status: {{ $brand->trashed() ? 'Deleted' : 'Active' }}</p>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-primary">Back to Brands</a>
        </div>
    </div>
</div>
@endsection
