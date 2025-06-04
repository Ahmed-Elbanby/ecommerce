@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $student->name }}'s Profile</h1>
        <a href="{{ route('student.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <ul class="nav nav-tabs" id="studentTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab">
                        Student Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="attachments-tab" data-toggle="tab" href="#attachments" role="tab">
                        Attachments ({{ $student->images->count() }})
                    </a>
                </li>
            </ul>

            <div class="tab-content mt-4">
                <!-- Profile Tab -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                    <div class="row">
                        <div class="col-md-4">
                            @if($student->image)
                            <!-- <img src="{{ Storage::disk('attachments')->url($student->image) }}"
                                class="img-fluid rounded mb-4"
                                alt="Profile Image"> -->
                            <!-- <img src="{{ asset('attachments/students/' . $student->image) }}"
                                class="img-fluid rounded mb-4"
                                alt="Profile Image"> -->
                            <img src="{{ Storage::disk('student_attachments')->url($student->image) }}"
                                class="img-fluid rounded mb-4"
                                alt="Profile Image">
                            @endif

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Quick Info</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $student->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td>{{ ucfirst($student->gender) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Birth Date</th>
                                            <td>{{ $student->birth_day }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                @foreach($student->images as $image)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="{{ Storage::disk('student_attachments')->url($image->path) }}"
                                            class="card-img-top"
                                            alt="Attachment">
                                        <div class="card-body text-center">
                                            <small class="text-muted">
                                                {{ $image->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attachments Tab -->
                <div class="tab-pane fade" id="attachments" role="tabpanel">
                    <div class="mb-4">
                        <form action="{{ route('student.upload_attachment', $student) }}"
                            method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"
                                        name="attachments[]"
                                        class="custom-file-input"
                                        id="attachmentsInput"
                                        multiple
                                        required>
                                    <label class="custom-file-label" for="attachmentsInput">
                                        Choose files...
                                    </label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        Upload Files
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>Upload Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student->images as $image)
                                <tr>
                                    <td>{{ $image->filename }}</td>
                                    <td>{{ $image->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <!-- <a href="{{ route('student.download_attachment', [$student, $image]) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-download"></i>
                                        </a> -->

                                        <!-- <a href="{{ route('student.download_attachment', ['student' => $student, 'filename' => $image->filename]) }}"
                                            class="btn btn-sm btn-primary">
                                            Download
                                        </a> -->

                                        {{-- Because $image->path is already "/storage/…/stu2.jfif", clicking this will download/serve the file directly. --}}
                                        <a href="{{ $image->path }}" download="{{ $image->filename }}" class="btn btn-sm btn-primary">
                                            Download
                                        </a>

                                        <form method="POST"
                                            action="{{ route('student.destroy_attachment', [$student, $image]) }}"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
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
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Update file input label
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var files = e.target.files;
        var label = document.querySelector('.custom-file-label');

        if (files.length > 1) {
            label.textContent = files.length + ' files selected';
        } else {
            label.textContent = files[0].name;
        }
    });
</script>
@endsection