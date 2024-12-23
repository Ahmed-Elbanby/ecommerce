@extends('layouts.dashboard')

@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-black">
            <h3>Edit Classroom</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('classroom.update', $classroom->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" value="{{ $classroom->name }}" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="faculty_id">Faculty:</label>
                    <select class="form-control" id="faculty_id" name="faculty_id" required>
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}" {{ $faculty->id == $classroom->faculty_id ? 'selected' : '' }}>
                            {{ $faculty->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create Faculty</button>
                <a href="{{ route('classroom.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection