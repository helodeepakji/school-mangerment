@include('layouts.main')

<!-- Datatables CSS -->
<link href="assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet"
    type="text/css" />

@include('layouts.menu')

<div class="content">
    <div class="container-fluid">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3 mt-3">
            <div class="my-auto mb-2">
                <h2 class="mb-1">Student List</h2>
            </div>
            <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                <div class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_student" class="btn btn-primary">
                        <i class="ri-add-circle-line mx-1"></i> Add Student
                    </a>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">All Students</h4>
                <table class="table table-striped dt-responsive nowrap w-100" id="datatable-buttons">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Date of Birth</th>
                            <th>Father Name</th>
                            <th>Mother Name</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>School</th>
                            <th>Address</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach($students as $student)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->class->name}}</td>
                                <td>{{ $student->dob}}</td>
                                <td>{{ $student->father_name }}</td>
                                <td>{{ $student->mother_name }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ ucfirst($student->gender) }}</td>
                                <td>{{ $student->school->name}}</td>
                                <td>{{ $student->address}}</td>
                                <td>

                                    <a href="#edit_user" onclick="getStudent({{$student->id}})" data-bs-toggle="modal"
                                        data-bs-target="#edit_user">
                                        <i class="ri-pencil-fill cursor-pointer"></i> </a>

                                    <a href="#delete_modal" data-bs-toggle="modal" data-bs-target="#delete_modal"
                                        onclick="getDelete({{$student->id}})">
                                        <i class="ms-2 ri-delete-bin-line cursor-pointer" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="add_student">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Student</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>

            <form action="{{ route('student-store') }}" method="post">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Student Name</label>
                                <input type="text" class="form-control" name="full_name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" name="dob" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-12">
                                <label class="form-label">Roll No.</label>
                                <input type="number" class="form-control" name="roll_no" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Father Name</label>
                                <input type="text" class="form-control" name="father_name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Mother Name</label>
                                <input type="text" class="form-control" name="mother_name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Phone No.</label>
                                <input type="text" class="form-control" name="phone" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">School</label>
                                <select name="school_id" id="school_id" class="form-control" required>
                                    <option value="">Select School</option>
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Class</label>
                                <select name="class_id" id="class_id" class="form-control" required>
                                    <option value="">Select Class</option>
                                    @foreach($class as $cla)
                                        <option value="{{ $cla->id }}">{{ $cla->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-12">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control">

                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Student</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Student Modal -->

<!-- Update Student -->
<div class="modal fade" id="edit_student">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Student</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="/student-update" method="post">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <input type="hidden" name="student_id" id="student_id" required>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Father Name</label>
                                <input type="text" class="form-control" name="father_name" id="father_name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Mother Name</label>
                                <input type="text" class="form-control" name="mother_name" id="mother_name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" name="dob" id="dob" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Gender</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Phone No.</label>
                                <input type="number" class="form-control" name="phone" id="phone" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="address" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">School</label>
                                <select name="school_id" id="school_id" class="form-control" required>
                                    <option value="">Select School</option>
                                    @foreach ($schools as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Class</label>
                                <select name="class_id" id="class_id" class="form-control" required>
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Student</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Update Student -->

<!-- Delete Modal -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Confirm Delete</h4>
                <p class="mb-3">You want to delete this student, this cant be undone once you delete.
                </p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                    <a onclick="deleteStudent()" class="btn btn-danger">Yes, Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Modal -->

@include('layouts.footer')

<!-- Datatables Scripts -->
<script src="assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="assets/js/pages/demo.datatable-init.js"></script>
<script>
    $('#school_id').change(() => {
        var id = $('#school_id').val();
        $.ajax({
            url: '/api/getClassBySchool/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#class_id').html('<option value="">Select Class</option>');
                response.forEach(element => {
                    $('#class_id').append(`<option value="${element.id}">${element.name}</option>`);
                });
            }
        });
    });
</script>