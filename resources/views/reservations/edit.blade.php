@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Reservation</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Customer:</strong>
                    <select name="customer_id" class="form-control">
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $customer->id == $reservation->customer_id ? 'selected' : '' }}>{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Employee:</strong>
                    <select name="employee_id" class="form-control">
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" {{ $employee->id == $reservation->employee_id ? 'selected' : '' }}>{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Reservation Time:</strong>
                    <input type="datetime-local" name="reservation_time" value="{{ $reservation->reservation_time }}" class="form-control" placeholder="Reservation Time">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Number of People:</strong>
                    <strong>Status:</strong>
                {{ $reservation->status }}
            </div>
        </div>
    </div>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('reservations.index') }}">Back</a>
    </div>
</div>
@endsection
