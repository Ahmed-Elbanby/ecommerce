@extends('layouts.dashboard')

@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-black">
            <h3>Create New Student</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('student.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <!-- <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="birth_day">Birth Day</label>
                    <input type="date" name="birth_day" id="birth_day" class="form-control" required>
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
                        <option value="">Select Classrooms</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="section_id">Section</label>
                    <select name="section_id" id="section_id" class="form-control" required>
                        <option value="">Select Section</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nationality_id">Nationality:</label>
                    <select class="form-control" id="nationality_id" name="nationality_id" required>
                        <option value="">Select Nationality</option>
                        @foreach ($nationalities as $nationality)
                        <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="parent_id">Parent:</label>
                    <select class="form-control" id="parent_id" name="parent_id" required>
                        <option value="">Select Parent</option>
                        @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="doctor_id">Doctor:</label>
                    <select class="form-control" id="doctor_id" name="doctor_id" required>
                        <option value="">Select Doctor</option>
                        @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div> -->

                <div class="row">
                    <!-- Gender -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>

                    <!-- Birth Day -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="birth_day">Birth Day</label>
                            <input type="date" name="birth_day" id="birth_day" class="form-control" required>
                        </div>
                    </div>

                    <!-- Hidden Status Field -->
                    <div class="col-md-2">
                        <input type="hidden" name="status" id="status" value="active">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                    </div>

                    <!-- Faculty -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="faculty_id">Faculty:</label>
                            <select class="form-control" id="faculty_id" name="faculty_id" required>
                                <option value="">Select Faculty</option>
                                @foreach ($faculties as $faculty)
                                <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Classroom -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="classroom_id">Classroom:</label>
                            <select class="form-control" id="classroom_id" name="classroom_id" required>
                                <option value="">Select Classrooms</option>
                            </select>
                        </div>
                    </div>

                    <!-- Section -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="section_id">Section</label>
                            <select name="section_id" id="section_id" class="form-control" required>
                                <option value="">Select Section</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Nationality -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nationality_id">Nationality:</label>
                            <select class="form-control" id="nationality_id" name="nationality_id" required>
                                <option value="">Select Nationality</option>
                                @foreach ($nationalities as $nationality)
                                <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Parent -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="parent_id">Parent:</label>
                            <select class="form-control" id="parent_id" name="parent_id" required>
                                <option value="">Select Parent</option>
                                @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Doctor -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="doctor_id">Doctor:</label>
                            <select class="form-control" id="doctor_id" name="doctor_id" required>
                                <option value="">Select Doctor</option>
                                @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create Student</button>
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