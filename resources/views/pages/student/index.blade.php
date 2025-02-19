<!-- resources/views/students/index.blade.php -->

@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Students List</h1>
    
    <form method="GET" action="{{ route('students.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <!-- <input type="text" class="form-control" name="name" placeholder="Search by Name" value="{{ request('name') }}"> -->
                <input type="text" class="form-control" name="search" placeholder="Search by Name or Email" value="{{ request('search') }}">
            </div>
            <!-- <div class="col-md-4">
                <input type="text" class="form-control" name="email" placeholder="Search by Email" value="{{ request('email') }}">
            </div> -->
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Birth Day</th>
                <th>Faculty ID</th>
                <th>Classroom ID</th>
                <th>Section ID</th>
                <th>Nationality ID</th>
                <th>Parent ID (Father Name)</th>
                <th>Doctor ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->gender }}</td>
                    <td>{{ $student->birth_day }}</td>
                    <td>{{ $student->faculty_id }}</td>
                    <td>{{ $student->classroom_id }}</td>
                    <td>{{ $student->section_id }}</td>
                    <td>{{ $student->nationality_id }}</td>
                    <td>{{ $student->parent ? $student->parent->father_name : 'N/A' }}</td>
                    <td>{{ $student->doctor_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection