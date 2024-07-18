@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menu Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $menu->name }}</h5>
            <p class="card-text">Price: Rp.{{format_rupiah ($menu->price) }}</p>
            
            @if($menu->photo)
                <img width="100px" height="100px" src="{{ asset('storage/' . $menu->photo) }}" alt="{{ $menu->name }}" class="img-fluid">
            @else
                <p>No photo available</p>
            @endif
            <div class="card-footer">
            <a href="{{ route('menus.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-primary">Edit</a>
        </div>
        </div>
    </div>
</div>
@endsection
