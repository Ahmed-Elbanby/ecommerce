<!-- resources/views/students/index.blade.php -->

@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Students List</h1>
    
    <!-- <form method="GET" action="{{ route('students.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" name="search" placeholder="Search by Name or Email" value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form> -->
    <form method="GET" action="{{ route('students.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" id="search" name="search" placeholder="Search by Name or Email" value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
    <a class="btn bg-gradient-primary btn-sm text-white" href="{{ route('student.create') }}">Create New</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Birth Date</th>
                <th>Faculty</th>
                <th>Classroom</th>
                <th>Section</th>
                <th>Nationality</th>
                <th>Parent(Father Name)</th>
                <th>Doctor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->gender }}</td>
                    <td>{{ $student->birth_day }}</td>
                    <td>{{ $student->faculty->name }}</td>
                    <td>{{ $student->classroom->name }}</td>
                    <td>{{ $student->section->name }}</td>
                    <td>{{ $student->nationality->name }}</td>
                    <td>{{ $student->parent->father_name }}</td>
                    <td>{{ $student->doctor->name }}</td>
                    <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('student.edit', $student->id) }}"
                                title="edit"><i class="fa fa-edit"></i></a>
                            <!-- <a class="btn btn-danger btn-sm" href="{{ route('classroom.destroy', $student->id) }}" onclick="return confirm('Are you sure you want to delete this faculty ?');" title="Delete"><i class="fa fa-trash"></i></a> -->
                            <form action="{{ route('student.destroy', $student->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE') <!-- Important for specifying the DELETE method -->
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this Student?');">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Real-Time Search Script -->
<script>
    $(document).ready(function () {
        // Listen for input changes in the search field
        $('#search').on('input', function () {
            const searchQuery = $(this).val(); // Get the search query

            // Send an AJAX request to the server
            $.ajax({
                url: "{{ route('students.index') }}", // Route to the index method
                method: 'GET',
                data: { search: searchQuery }, // Send the search query as a parameter
                success: function (response) {
                    // Replace the table body with the updated results
                    $('#students-table-body').html(response);
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });
    });
</script>
@endsection