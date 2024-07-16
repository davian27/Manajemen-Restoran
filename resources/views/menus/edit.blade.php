@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Menu</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Menu Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $menu->name }}">
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ $menu->price }}">
        </div>
        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" class="form-control" id="photo" name="photo">
            @if($menu->photo)
                <img src="/{{ $menu->photo }}" alt="{{ $menu->name }}" width="100">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('menus.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
