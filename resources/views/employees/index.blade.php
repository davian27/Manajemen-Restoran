@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employees</h1>
    <a href="{{ route('employees.create') }}" class="btn btn-primary">Add New Employee</a>

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
                <th>Position</th>
                <th>Gaji Karyawan</th>
                <th>Hired Date</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>{{format_rupiah ($employee->salary) }}</td>
                    <td>{{ $employee->hired_date }}</td>
                    <td>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirmDelete()">
                            <a class="btn btn-info" href="{{ route('employees.show', $employee->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('employees.edit', $employee->id) }}">Edit</a>

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
        return confirm('Are you sure you want to delete this employee?');
    }
</script>
@endsection
