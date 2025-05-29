@include('layouts.main')

<!-- DataTables CSS -->
<link href="/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="/assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />

@include('layouts.menu')

<div class="content">
    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="d-flex justify-content-between mt-3 mb-3">
            <h2>Student List</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_student">Add Student</button>
        </div>

        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>School</th>
                            <th>Phone</th>
                            <th>Class</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $key => $student)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $student->profile_image) }}" width="40" class="rounded-circle">
                                </td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->school->name }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->class }}</td>
                                <td>
                                    <button onclick="editStudent({{ $student->id }})" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#edit_student">Edit</button>
                                    <button onclick="confirmDelete({{ $student->id }})" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal">Delete</button>
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
    <div class="modal-dialog">
        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5>Add Student</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row">
                <x-student-form :schools="$schools" />
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="edit_student">
    <div class="modal-dialog">
        <form id="edit_student_form" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5>Edit Student</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row" id="edit_student_body"></div>
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-3">
            <h4>Are you sure?</h4>
            <p>This action cannot be undone.</p>
            <form id="delete_form" method="POST">
                @csrf @method('DELETE')
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')

<!-- Scripts -->
<script src="/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>

<script>
    function editStudent(id) {
        fetch(`/students/${id}/edit`)
            .then(res => res.text())
            .then(html => {
                document.getElementById('edit_student_body').innerHTML = html;
                document.getElementById('edit_student_form').action = `/students/${id}`;
            });
    }

    function confirmDelete(id) {
        document.getElementById('delete_form').action = `/students/${id}`;
    }
</script>
