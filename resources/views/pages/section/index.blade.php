@extends('layouts.dashboard')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">All Sections</h1>
<a class="btn bg-gradient-primary btn-sm text-white" href="{{ route('section.create') }}">Create New</a>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
        DataTables documentation</a>.</p>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sections</h6>
    </div>
    <div id="accordion">
        @foreach ($faculties as $faculty)
            <div class="card">
                <div class="card-header" id="heading{{ $faculty->id }}" data-toggle="collapse" data-target="#collapse{{ $faculty->id }}"
                    aria-expanded="false" aria-controls="collapse{{ $faculty->id }}">
                    <h5 class="mb-0">
                        <button class="btn btn-link">
                            {{ $faculty->name }}
                        </button>
                    </h5>
                </div>

                <div id="collapse{{ $faculty->id }}" class="collapse" aria-labelledby="heading{{ $faculty->id }}" data-parent="#accordion">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Section Name</th>
                                        <th>Classrooms</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php    $i = 0 ?>
                                    @foreach($sections as $section)
                                        <tr>
                                            <?php        $i++ ?>
                                            <td>{{ $i }}</td>
                                            <td>{{ $section->name }}</td>
                                            <td>{{ $section->classroom->name }}</td>
                                            <td>{{ $section->status }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('section.edit', $section->id) }}" title="edit"><i
                                                        class="fa fa-edit"></i></a>
                                                <form action="{{ route('section.destroy', $section->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE') <!-- Important for specifying the DELETE method -->
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this Section?');">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


@endsection