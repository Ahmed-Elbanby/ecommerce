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
        <div class="card">
            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                <h5 class="mb-0">
                    <button class="btn btn-link">
                        Accordion Item #1
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    This is the first item's accordion body.
                </div>
            </div>
        </div>
        <div class="card">
            <div data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"
                class="card-header collapsed" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link">
                        Accordion Item #2
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    This is the second item's accordion body.
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Faculty</th>
                        <th>Classroom</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                    @foreach($sections as $section)
                        <tr>
                            <?php    $i++ ?>
                            <td>{{ $i }}</td>
                            <td>{{ $section->name }}</td>
                            <td>{{ $section->status }}</td>
                            <td>{{ $section->faculty->name }}</td>
                            <td>{{ $section->classroom->name }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('section.edit', $section->id) }}"
                                    title="edit"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('section.destroy', $section->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
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
    </div> -->
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


@endsection