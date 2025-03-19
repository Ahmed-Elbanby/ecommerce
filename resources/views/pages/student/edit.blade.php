@extends('layouts.dashboard')

@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-black">
            <h3>Edit Student</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('student.update', $student->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Photo</label>
                    <input type="file" class="form-control-file" name="image">
                </div>

                <!-- Name Field -->
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
                </div>

                <!-- Hidden Status Field -->
                <input type="hidden" name="status" id="status" value="{{ $student->status }}">
                <meta name="csrf-token" content="{{ csrf_token() }}">

                <!-- Gender and Birth Day Row -->
                <div class="row">
                    <!-- Gender -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>

                    <!-- Birth Day -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="birth_day">Birth Day</label>
                            <input type="date" name="birth_day" id="birth_day" class="form-control" value="{{ $student->birth_day }}" required>
                        </div>
                    </div>
                </div>

                <!-- Faculty, Classroom, and Section Row -->
                <div class="row">
                    <!-- Faculty -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="faculty_id">Faculty:</label>
                            <select class="form-control" id="faculty_id" name="faculty_id" required>
                                <option value="">Select Faculty</option>
                                @foreach ($faculties as $faculty)
                                <option value="{{ $faculty->id }}" {{ $faculty->id == $student->faculty_id ? 'selected' : '' }}>
                                    {{ $faculty->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Classroom -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="classroom_id">Classroom:</label>
                            <select class="form-control" id="classroom_id" name="classroom_id" required>
                                <option value="">Select Classroom</option>
                                @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}" {{ $classroom->id == $student->classroom_id ? 'selected' : '' }}>
                                    {{ $classroom->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Section -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="section_id">Section:</label>
                            <select class="form-control" id="section_id" name="section_id" required>
                                <option value="">Select Section</option>
                                @foreach ($sections as $section)
                                <option value="{{ $section->id }}" {{ $section->id == $student->section_id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Nationality, Parent, and Doctor Row -->
                <div class="row">
                    <!-- Nationality -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nationality_id">Nationality:</label>
                            <select class="form-control" id="nationality_id" name="nationality_id" required>
                                <option value="">Select Nationality</option>
                                @foreach ($nationalities as $nationality)
                                <option value="{{ $nationality->id }}" {{ $nationality->id == $student->nationality_id ? 'selected' : '' }}>
                                    {{ $nationality->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Parent -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="parent_id">Parent:</label>
                            <select class="form-control" id="parent_id" name="parent_id" required>
                                <option value="">Select Parent</option>
                                @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}" {{ $parent->id == $student->parent_id ? 'selected' : '' }}>
                                    {{ $parent->father_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Doctor -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="doctor_id">Doctor:</label>
                            <select class="form-control" id="doctor_id" name="doctor_id" required>
                                <option value="">Select Doctor</option>
                                @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ $doctor->id == $student->doctor_id ? 'selected' : '' }}>
                                    {{ $doctor->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Submit and Cancel Buttons -->
                <button type="submit" class="btn btn-primary">Update Student</button>
                <a href="{{ route('student.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom jQuery for Dynamic Dropdowns -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        // When Faculty is selected, load Classrooms
        $('#faculty_id').change(function() {
            const facultyId = $(this).val();
            const classroomSelect = $('#classroom_id');

            if (facultyId) {
                classroomSelect.empty().append('<option value="">Loading...</option>');
                $.ajax({
                    url: `/classrooms/${facultyId}`,
                    type: 'GET',
                    success: function(response) {
                        classroomSelect.empty().append('<option value="">Select Classroom</option>');
                        response.forEach(classroom => {
                            classroomSelect.append(`<option value="${classroom.id}">${classroom.name}</option>`);
                        });
                    },
                    error: function() {
                        alert('Failed to load classrooms. Please try again.');
                    }
                });
            } else {
                classroomSelect.empty().append('<option value="">Select Classroom</option>');
            }
        });

        // When Classroom is selected, load Sections
        $('#classroom_id').change(function() {
            const classroomId = $(this).val();
            const sectionSelect = $('#section_id');

            if (classroomId) {
                sectionSelect.empty().append('<option value="">Loading...</option>');
                $.ajax({
                    url: `/sections/${classroomId}`,
                    type: 'GET',
                    success: function(response) {
                        sectionSelect.empty().append('<option value="">Select Section</option>');
                        response.forEach(section => {
                            sectionSelect.append(`<option value="${section.id}">${section.name}</option>`);
                        });
                    },
                    error: function() {
                        alert('Failed to load sections. Please try again.');
                    }
                });
            } else {
                sectionSelect.empty().append('<option value="">Select Section</option>');
            }
        });
    });
</script>

@endsection