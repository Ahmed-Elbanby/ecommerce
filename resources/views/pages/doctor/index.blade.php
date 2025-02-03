@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Doctors</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('doctor.create') }}" class="btn btn-primary mb-3">Add Doctor</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Faculty</th>
                        <th>Classroom</th>
                        <th>Section</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)
                        <tr>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->email }}</td>
                            <td>{{ $doctor->faculty->name ?? 'N/A' }}</td>
                            <td>{{ $doctor->classroom->name ?? 'N/A' }}</td>
                            <td>{{ $doctor->section->name ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('doctor.edit', $doctor->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('doctor.destroy', $doctor->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection