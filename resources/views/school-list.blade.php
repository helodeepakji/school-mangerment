@include('layouts.main')
<!-- Daterangepicker css -->
<link href="assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet"
    type="text/css" />
<link href="assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css" rel="stylesheet"
    type="text/css" />
<link href="assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css" rel="stylesheet"
    type="text/css" />
<link href="assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
</head>

@include('layouts.menu')

<!-- content -->

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3 mt-3">
            <div class="my-auto mb-2">
                <h2 class="mb-1">School List</h2>
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="admin-dashboard.php"><i class="ti ti-smart-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            School
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">School List</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
                <div class="mb-2 me-2">
                    <a class="btn btn-danger d-flex align-items-center"><i class="ri-wifi-off-line mx-1"></i>Expairy
                        School</a>
                </div>
                <div class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_company"
                        class="btn btn-primary d-flex align-items-center"><i class="ri-add-circle-line mx-1"></i>Add
                        School</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title">School List</h4>

                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Company Name</th>
                                    <th>Admin Name</th>
                                    <th>Max People</th>
                                    <th>Contact</th>
                                    <th>Expairy date</th>
                                    <th>Total Leads</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <img src="assets/images/buildings.png'" alt="company-logo" width="32"
                                            class="rounded-circle">
                                        Test School
                                    </td>
                                    <td>
                                        <img src="assets/images/buildings.png'" alt="company-logo" width="32"
                                            class="rounded-circle">
                                        Test School
                                    </td>
                                    <td>1000</td>
                                    <td>Deepak
                                    </td>
                                    <td>25 May 2025
                                    </td>
                                    <td>16</td>
                                    <td>

                                        <a href="#edit_company" data-bs-toggle="modal" data-bs-target="#edit_company">
                                            <i class="ri-pencil-fill cursor-pointer"></i> </a>

                                        <a href="#delete_modal" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                            <i class="ms-2 ri-delete-bin-line cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#delete_modal"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->

    </div>
    <!-- container -->

</div>

<!-- Add Company -->
<div class="modal fade" id="add_company">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Company</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="/companies-list" method="post">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Company Name</label>
                                <input type="text" class="form-control" name="company_name" required>
                                <input type="hidden" name="type" value="addCompany">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Admin Name</label>
                                <input type="text" class="form-control" name="admin_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Phone No.</label>
                                <input type="number" class="form-control" name="phone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Max People</label>
                                <input type="number" class="form-control" name="max_people" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Expairy Date</label>
                                <input type="text" class="form-control date" name="expiry_date" id="expiry_date">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Company</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add Company -->

<!-- Edit Company -->
<div class="modal fade" id="edit_company">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Company</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="/company-edit" method="post">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Company Name</label>
                                <input type="text" class="form-control" name="company_name" id="company_name" required>
                                <input type="hidden" name="company_id" id="company_id">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Admin Name</label>
                                <input type="text" class="form-control" name="admin_name" id="admin_name" required>
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
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Max People</label>
                                <input type="number" class="form-control" name="max_people" id="max_people" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Expairy Date</label>
                                <input type="text" class="form-control date" name="expiry_date" id="edit_expiry_date">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Edit Company -->


<!-- Delete Modal -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Confirm Delete</h4>
                <p class="mb-3">You want to delete this company, this cant be undone once you delete.
                </p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                    <a onclick="getDelete()" class="btn btn-danger">Yes, Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Modal -->


<!-- content -->



@include('layouts.footer')


<!-- Datatables js -->
<script src="assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js"></script>
<script src="assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>

<!-- Datatable Demo Aapp js -->
<script src="assets/js/pages/demo.datatable-init.js"></script>
<!-- App js -->
</body>

</html>