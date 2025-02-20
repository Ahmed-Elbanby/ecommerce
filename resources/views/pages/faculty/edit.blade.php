@extends('layouts.dashboard')

@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-black">
            <h3>Edit Faculty</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('faculty.update', $faculty->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" value="{{ $faculty->name }}" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="note">Note:</label>
                    <textarea class="form-control" id="note" name="note" rows="3">{{ $faculty->note }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Faculty</button>
                <a href="{{ route('faculty.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection