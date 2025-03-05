@extends('layouts.dashboard')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">All Classroom</h1>
<a class="btn bg-gradient-primary btn-sm text-white" href="{{ route('classroom.create') }}">Create New</a>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
        DataTables documentation</a>.</p>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Classrooms</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Faculty</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                    @foreach($classrooms as $classroom)
                    <tr>
                        <?php $i++ ?>
                        <td>{{ $i }}</td>
                        <td>{{ $classroom->name }}</td>
                        <td>{{ $classroom->faculty ? $classroom->faculty->name : 'No Faculty' }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('classroom.edit', $classroom->id) }}"
                                title="edit"><i class="fa fa-edit"></i></a>
                            <!-- <a class="btn btn-danger btn-sm" href="{{ route('classroom.destroy', $classroom->id) }}" onclick="return confirm('Are you sure you want to delete this faculty ?');" title="Delete"><i class="fa fa-trash"></i></a> -->
                            <form action="{{ route('classroom.destroy', $classroom->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE') <!-- Important for specifying the DELETE method -->
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this Classroom?');">
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
</div>
@endsection