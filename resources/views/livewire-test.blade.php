@extends('layouts.dashboard')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">LiveWire Test</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
        DataTables documentation</a>.</p>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">LiveWire Test</h6>
    </div>
    <div class="card-body">
    <livewire:counter />
    </div>
</div>
@endsection