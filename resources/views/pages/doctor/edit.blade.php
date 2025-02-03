@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Edit Doctor</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('doctor.update', $doctor->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $doctor->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $doctor->email }}" required>
                </div>
                <div class="form-group">
                    <label for="password">New Password (Leave Blank No Changes):</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="faculty_id">Faculty:</label>
                    <select class="form-control" id="faculty_id" name="faculty_id" required>
                        <option value="">Select Faculty</option>
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}" {{ $faculty->id == $doctor->faculty_id ? 'selected' : '' }}>
                                {{ $faculty->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="classroom_id">Classroom:</label>
                    <select class="form-control" id="classroom_id" name="classroom_id" required>
                        <option value="">Select Classroom</option>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{ $classroom->id == $doctor->classroom_id ? 'selected' : '' }}>
                                {{ $classroom->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="section_id">Section:</label>
                    <select class="form-control" id="section_id" name="section_id" required>
                        <option value="">Select Section</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}" {{ $section->id == $doctor->section_id ? 'selected' : '' }}>
                                {{ $section->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Doctor</button>
            </form>
            <script>
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).ready(function () {
                    const facultySelect = $('#faculty_id');
                    const classroomSelect = $('#classroom_id');
                    const sectionSelect = $('#section_id');

                    function fetchClassrooms(facultyId) {
                        if (facultyId) {
                            classroomSelect.empty().append('<option value="">Loading...</option>');
                            $.ajax({
                                url: `/classrooms/${facultyId}`,
                                type: 'GET',
                                success: function (response) {
                                    classroomSelect.empty();
                                    if (response.length === 0) {
                                        classroomSelect.append('<option value="">No Classrooms Found</option>');
                                    } else {
                                        response.forEach(classroom => {
                                            classroomSelect.append(`<option value="${classroom.id}">${classroom.name}</option>`);
                                        });
                                    }
                                },
                                error: function () {
                                    classroomSelect.empty().append('<option value="">Failed to load classrooms</option>');
                                }
                            });
                        } else {
                            classroomSelect.empty().append('<option value="">Select Classroom</option>');
                        }
                    }

                    function fetchSections(classroomId) {
                        if (classroomId) {
                            sectionSelect.empty().append('<option value="">Loading...</option>');
                            $.ajax({
                                url: `/sections/${classroomId}`,
                                type: 'GET',
                                success: function (response) {
                                    sectionSelect.empty();
                                    if (response.length === 0) {
                                        sectionSelect.append('<option value="">No Sections Found</option>');
                                    } else {
                                        response.forEach(section => {
                                            sectionSelect.append(`<option value="${section.id}">${section.name}</option>`);
                                        });
                                    }
                                },
                                error: function () {
                                    sectionSelect.empty().append('<option value="">Failed to load sections</option>');
                                }
                            });
                        } else {
                            sectionSelect.empty().append('<option value="">Select Section</option>');
                        }
                    }

                    facultySelect.change(function () {
                        const facultyId = $(this).val();
                        fetchClassrooms(facultyId);
                        const classroomId = $(this).val();
                        fetchSections(classroomId);
                    });

                    classroomSelect.change(function () {
                        const classroomId = $(this).val();
                        fetchSections(classroomId);
                    });
                });
            </script>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection