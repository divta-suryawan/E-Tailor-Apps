@extends('../layouts/base')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">User Management</h1>
        </div>
    </div>
@endsection
@section('main-content')
    <div class="col-12">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <button type="button" class="btn btn-outline-primary ml-auto" data-toggle="modal" data-target="#UserManagementModal"
                    id="#myBtn">
                    Tambah Data
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-striped table-responsive-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <div class="modal fade" id="UserManagementModal" tabindex="-1" role="dialog" aria-labelledby="TailorLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TailorLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambah" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row py-2">
                            <div class="col-md-12">
                                <input type="hidden" name="id" id="id" value="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama </label>
                                            <input type="text" class="form-control" placeholder="Nama User"
                                                name="name" id="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" placeholder="Email" name="email"
                                                id="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tailor_name">Password</label>
                                            <input type="password" class="form-control" placeholder="Password"
                                                name="password" id="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Konfirmasi Password</label>
                                            <input type="password" class="form-control" placeholder="Password Confirmation" name="password_confirmation"
                                                id="password_confirmation">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" form="formTambah" class="btn btn-outline-primary">Create User</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var dataTable = $("#dataTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
            console.log(dataTable)
            $.ajax({
                type: "get",
                url: "{{ url('api/v1/auth') }}",
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    let tableBody = '';
                    $.each(response.data, function(index, item) {
                        tableBody += "<tr>";
                        tableBody += "<td>" + (index + 1) + "</td>";
                        tableBody += "<td>" + item.name + "</td>";
                        tableBody += "<td>" + item.email + "</td>";
                        tableBody += "<td>" +
                            "<button type='button' class='btn btn-primary edit-modal' data-toggle='modal' data-target='#EditModal' " +
                            "data-id='" + item.id + "'>" +
                            "<i class='fa fa-edit'></i></button>" +
                            "<button type='button' class='btn btn-danger delete-confirm' data-id='" +
                            item.id + "'><i class='fa fa-trash'></i></button>" +
                            "</td>";
                        tableBody += "</tr>";
                    });
                    let table = $("#dataTable").DataTable();
                    table.clear().draw();
                    table.rows.add($(tableBody)).draw();
                },
                error: function() {
                    console.log("Failed to get data from the server");
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let isEditMode = false;

            function showModal(editMode = false, id = '') {
                isEditMode = editMode;
                if (isEditMode) {
                    $('.modal-title').text('Edit Data');
                    $('.modal-footer button[type="submit"]').text('Update');
                    $('#preview').show()
                } else {
                    $('.modal-title').text('Tambah Data');
                    $('.modal-footer button[type="submit"]').text('Submit');
                    $('#preview').hide()
                }
                $('#UserManagementModal').modal('show');
            }

            $('#formTambah').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let id = $('#id').val();
                console.log(formData)
                let url = isEditMode ? "{{ url('api/v1/auth/updateData') }}/" + id :
                    "{{ url('api/v1/auth/createData') }}";
                console.log(url)
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data)
                        if (data.message === 'Check your validation') {
                            Swal.fire({
                                title: 'Error',
                                html: data.errors,
                                icon: 'error',
                                timer: 5000,
                                showConfirmButton: true
                            });
                        } else {
                            resetModal()
                            console.log(data);
                            $('#loading-overlay').hide();
                            Swal.fire({
                                title: isEditMode ? 'Success' : 'Data Success Create',
                                text: isEditMode ? 'Data Success Update' :
                                    'Data Success Create',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location.reload();
                            });
                        }
                    },
                    error: function(data) {
                        Swal.fire({
                            title: 'Error',
                            html: 'Server bermasalah',
                            icon: 'error',
                            timer: 5000,
                            showConfirmButton: true
                        });
                    }
                });
            });

            $(document).on('click', '.edit-modal', function() {
                let id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: "{{ url('api/v1/auth/getDataById') }}/" + id,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data);
                        showModal(true);
                        $('#id').val(data.data.id);
                        $('#name').val(data.data.name);
                        $('#email').val(data.data.email);
                    },
                    error: function() {
                        alert("error");
                    }
                });
            });

            function resetModal() {
                $('#id').val('');
                $('#name').val('');
                $('#email').val('');
            }

            $('#UserManagementModal').on('hidden.bs.modal', function() {
                if (isEditMode) {
                    resetModal();
                }
                isEditMode = false;
                $('.modal-title').text('Tambah Data');
                $('.modal-footer button[type="submit"]').text('Submit');
            });

            $(document).on('click', '.delete-confirm', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Hapus ?',
                    text: 'Anda tidak dapat mengembalikan  ini',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Delete',
                    cancelButtonText: 'Cancel',
                    resolveButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('api/v1/auth/deleteData') }}/" + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id
                            },
                            success: function(response) {
                                if (response.message === 'Failed') {
                                    Swal.fire({
                                        title: 'Gagal menghapus data',
                                        text: response.message,
                                        icon: 'error',
                                        timer: 5000,
                                        showConfirmButton: true
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Success',
                                        text: 'Data berhasil dihapus',
                                        icon: 'success',
                                        timer: 5000,
                                        showConfirmButton: true
                                    }).then(function() {
                                        window.location.reload();
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Terjadi kesalahan',
                                    icon: 'error',
                                    timer: 5000,
                                    showConfirmButton: true
                                });
                            }
                        });
                    }
                })
            });
        });
    </script>
@endsection
