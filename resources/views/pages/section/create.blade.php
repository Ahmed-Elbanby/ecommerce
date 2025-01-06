@extends('layouts.dashboard')

@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-black">
            <h3>Create New Section</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('section.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <input type="hidden" name="status" id="status" value="active">

                <meta name="csrf-token" content="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="faculty_id">Faculty:</label>
                    <select class="form-control" id="faculty_id" name="faculty_id" required>
                        <option value="">Select Faculty</option>
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="classroom_id">Classroom:</label>
                    <select class="form-control" id="classroom_id" name="classroom_id" required>
                        <option value="">Select Classroom</option>
                    </select>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#faculty_id').on('change', function () {
                            // var facultyId = $(this).val();
                            let facultyId = $(this).val();
                            $('#classroom_id').html('<option value="">Loading...</option>');

                            $.ajax({
                                url: "{{ URL::to('classroom') }}/" + facultyId,
                                type: 'GET',
                                dataType: 'json',
                                success: function (data) {
                                    $('#classroom_id').empty();
                                    $.each(data, function (key, value) {
                                        $('#classroom_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                                    });
                                }
                                error: function (xhr, status, error) {
                                    $('#classroom_id').html('<option value="">Error loading classrooms. Please try again.</option>');
                                    console.error('Error:', error);
                                }
                            });
                        });
                    });
                </script>
                <button type="submit" class="btn btn-primary">Create Classroom</button>
                <a href="{{ route('section.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection