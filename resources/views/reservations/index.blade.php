@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reservations</h1>
    <a href="{{ route('reservations.create') }}" class="btn btn-primary">Add New Reservation</a>

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
                <th>Customer</th>
                <th>Employee</th>
                <th>Reservation Time</th>
                <th>Number of People</th>
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $reservation->customer->name }}</td>
                    <td>{{ $reservation->employee->name }}</td>
                    <td>{{ $reservation->reservation_time }}</td>
                    <td>{{ $reservation->number_of_people }}</td>
                    <td>{{ $reservation->status }}</td>
                    <td>
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirmDelete()">
                            <a class="btn btn-info" href="{{ route('reservations.show', $reservation->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('reservations.edit', $reservation->id) }}">Edit</a>

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
        return confirm('Are you sure you want to delete this reservation?');
    }
</script>
@endsection
