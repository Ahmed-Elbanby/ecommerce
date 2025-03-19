<!-- @extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Student Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $student->name }}</h5>
            <p class="card-text">
                <strong>Email:</strong> {{ $student->email }}<br>
                <strong>Gender:</strong> {{ $student->gender }}<br>
                <strong>Birth Date:</strong> {{ $student->birth_day }}<br>
                <strong>Faculty:</strong> {{ $student->faculty->name }}<br>
                <strong>Classroom:</strong> {{ $student->classroom->name }}<br>
                <strong>Section:</strong> {{ $student->section->name }}<br>
                <strong>Nationality:</strong> {{ $student->nationality->name }}<br>
                <strong>Father's Name:</strong> {{ $student->parent->father_name }}<br>
                <strong>Doctor:</strong> {{ $student->doctor->name }}
            </p>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection -->

@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Student Details</h1>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                @if ($student->image)
                <img src="{{ asset('storage/' . $student->image) }}"
                    alt="Profile"
                    style="max-width: 200px; max-height: 200px;">
                <br>
                <!-- <a href="{{ route('student.download', $student->id) }}"
                    class="btn btn-success btn-sm mt-2">
                    Download Photo
                </a> -->
                @else
                No Image Uploaded
                @endif
            </div>
            <h5 class="card-title">{{ $student->name }}</h5>
            <p class="card-text">
                <strong>Email:</strong> {{ $student->email }}<br>
                <strong>Gender:</strong> {{ $student->gender }}<br>
                <strong>Birth Date:</strong> {{ $student->birth_day }}<br>
                <!-- Add other fields here -->
            </p>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection