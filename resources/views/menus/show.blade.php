@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menu Details</h1>

    <div class="card">
        <div class="card-header">
            <h2>Nama Menu : {{ $menu->name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Price:</strong> {{format_rupiah ($menu->price) }}</p>
            @if($menu->photo)
                <div>
                    <strong>Photo:</strong><br>
                    <img src="/{{ $menu->photo }}" alt="{{ $menu->name }}" class="img-fluid" width="300">
                </div>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('menus.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection
