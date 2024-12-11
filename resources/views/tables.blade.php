@extends('layouts.dashboard')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Notes</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Notes</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $i = 0 ?>
                                        @foreach($faculties as $faculty)
                                        <tr>
                                            <?php $i++ ?>
                                            <td>{{ $i }}</td>
                                            <td>{{ $faculty->name }}</td>
                                            <td>{{ $faculty->note }}</td>
                                            <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_{{ $faculty->id }}" title="edit"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_{{ $faculty->id }}" title="edit"><i class="fa fa-edit"></i></button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection