@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Reservation Details</h4>
                    <a class="btn btn-primary float-end" href="{{ route('reservations.index') }}">Back</a>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Customer Name:</strong>
                        {{ $reservation->customer->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Employee Name:</strong>
                        {{ $reservation->employee->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Reservation Time:</strong>
                        {{ $reservation->reservation_time }}
                    </div>
                    <div class="mb-3">
                        <strong>Number of People:</strong>
                        {{ $reservation->number_of_people }}
                    </div>
                    <div class="mb-3">
                        <strong>Status:</strong>
                        {{ $reservation->status }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
