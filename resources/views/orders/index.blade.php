@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Orders</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-primary">Add New Order</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Menu</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->menu->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ format_rupiah ($order->total_price) }}</td>
                    <td>
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirmDelete()">
                            <a class="btn btn-info" href="{{ route('orders.show', $order->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('orders.edit', $order->id) }}">Edit</a>

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
        return confirm('Are you sure you want to delete this order?');
    }
</script>
@endsection
