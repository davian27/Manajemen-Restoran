@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menus</h1>
    <a href="{{ route('menus.create') }}" class="btn btn-primary">Add New Menu</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger mt-3">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Price</th>
                <th>Product Image</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
                <tr>
                    <td>{{ $menu->id }}</td>
                    <td>{{ $menu->name }}</td>
                    <td>{{format_rupiah ($menu->price) }}</td>
                    <td><img width="100px" height="100px" src="{{ asset('storage/' . $menu->photo) }}" alt="{{ $menu->name }}" class="img-fluid"></td>
                    <td>
                    <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirmDelete()">
                            <a class="btn btn-primary" href="{{ route('menus.edit', $menu->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this menu ?');
    }
</script>
@endsection
