@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Brands</h3>
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('brands.create') }}" class="btn btn-primary">Create New Brand</a>
                @endif
            </div>
            <div class="card-body">
                @if ($brands->isEmpty())
                    <div class="alert alert-warning text-center">No brands available.</div>
                @else
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                @if (Auth::check() && Auth::user()->role === 'admin')
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td>{{ $brand->name }}</td>
                                    @if (Auth::check() && Auth::user()->role === 'admin')
                                        <td>
                                            <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
