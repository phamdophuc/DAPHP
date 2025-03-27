@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Brand</h1>
        <form action="{{ route('brands.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Create</button>
            <a href="{{ route('brands.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection