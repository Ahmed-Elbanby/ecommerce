@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Students List</h1>

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

    <div class="table-responsive">
        <table id="students-table" class="table table-striped">
            <thead>
                <tr>
                    <th>Photo</th>
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <!-- <td>
                        @if ($student->image)
                        <img src="{{ asset('storage/' . $student->image) }}"
                            alt="Profile"
                            style="max-width: 50px; max-height: 50px;">
                        @else
                        No Image
                        @endif
                    </td> -->
                    <!-- <td>
                        @if ($student->image)
                        <img src="{{ asset('attachments/students/' . $student->image) }}"
                            style="max-width: 50px; max-height: 50px;">
                        @else
                        No Image
                        @endif
                    </td> -->
                    <td>
                        @if($student->images->isNotEmpty())
                        <img src="{{ Storage::disk('student_attachments')->url($student->images->first()->path) }}"
                            style="width: 50px; height: 50px; object-fit: cover;"
                            class="rounded">
                        @else
                        <span class="text-muted">No image</span>
                        @endif
                    </td>
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
                        <a class="btn btn-info btn-sm" href="{{ route('student.show', $student->id) }}" title="View Details">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="btn btn-primary btn-sm" href="{{ route('student.edit', $student->id) }}" title="edit"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Student?');">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include DataTables CSS and JS -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css"> -->
<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script> -->

<!-- Initialize DataTable -->
<!-- <script>
    $(document).ready(function () {
        $('#students-table').DataTable({
            responsive: true,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            }
        });
    });
</script> -->
@endsection