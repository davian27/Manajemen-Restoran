@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Menu</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Menu Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
        </div>
        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('menus.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
