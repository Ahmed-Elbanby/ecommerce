@extends('layouts.dashboard')

@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-black">
            <h3>Edit Section</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('section.update', $section->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $section->name }}" required>
                </div>

                <input type="hidden" name="status" id="status" value="active">

                <meta name="csrf-token" content="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="faculty_id">Faculty:</label>
                    <select class="form-control" id="faculty_id" name="faculty_id" required>
                        <option value="">Select Faculty</option>
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}" {{ $faculty->id == $section->faculty_id ? 'selected' : '' }}>
                                {{ $faculty->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="classroom_id">Classroom:</label>
                    <select class="form-control" id="classroom_id" name="classroom_id" required>
                        <option value="">Select Classrooms</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Classroom</button>
                <a href="{{ route('section.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        // $('#faculty_id').change(function () {
        // const facultyId = $(this).val();
        // const classroomSelect = $('#classroom_id');

        const facultySelect = $('#faculty_id'); // Faculty dropdown
        const classroomSelect = $('#classroom_id'); // Classroom dropdown

        // Get the selected faculty ID and classroom ID on page load
        const selectedFacultyId = facultySelect.val(); // Already pre-selected from PHP
        const selectedClassroomId = '{{ $section->classroom_id }}'; // Pass this from PHP

        function fetchClassrooms(facultyId, selectedClassroomId = null) {
            if (facultyId) {
                classroomSelect.empty().append('<option value="">Loading...</option>');
                $.ajax({
                    url: `/classrooms/${facultyId}`,
                    type: 'GET',
                    data: { section_classroom_id: selectedClassroomId },
                    // success: function (response) {
                    //     classroomSelect.empty();
                    //     const isSelected = classroom.is_selected ? 'selected' : '';
                    //     response.forEach(classroom => {
                    //         classroomSelect.append(`<option value="${classroom.id}" ${isSelected}>${classroom.name}</option>`);
                    //     });
                    // },
                    // error: function () {
                    //     alert('Failed to load classrooms. Please try again.');
                    // }
                    success: function (response) {
                        classroomSelect.empty();
                        if (response.length === 0) {
                            classroomSelect.append('<option value="">No Classrooms Found</option>');
                        } else {
                            response.forEach(classroom => {
                                const isSelected = classroom.id == selectedClassroomId ? 'selected' : '';
                                classroomSelect.append(`<option value="${classroom.id}" ${isSelected}>${classroom.name}</option>`);
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        if (status === '404') {
                            classroomSelect.empty().append('<option value="">Classroom Id NOT Exist</option>');
                        } else {
                            classroomSelect.empty().append(`<option value="">${error}</option>`);
                        }
                    }
                });
            } else {
                classroomSelect.empty().append('<option value="">Select Classrooms</option>');
            }
        }
        if (selectedFacultyId) {
            fetchClassrooms(selectedFacultyId, selectedClassroomId);
        }
        facultySelect.change(function () {
            const facultyId = $(this).val(); // Get the newly selected faculty
            fetchClassrooms(facultyId); // Fetch classrooms for the new faculty
        });
        // });
    });
</script>

@endsection