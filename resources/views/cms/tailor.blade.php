@extends('../layouts/base')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">admin</h1>
        </div>
    </div>
@endsection
@section('main-content')
    <div class="col-12">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h3 class="card-title">Tablet</h3>
                <button type="button" class="btn btn-outline-primary ml-auto" data-toggle="modal" data-target="#TailorModal"
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
                                <th>Nama Tailor</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>No hp</th>
                                <th>Gambar</th>
                                <th>Deskripsi</th>
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

    <div class="modal fade" id="TailorModal" tabindex="-1" role="dialog" aria-labelledby="TailorLabel" aria-hidden="true">
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
                                <div class="text-center">
                                    <img src="" alt="" id="preview" class="mx-auto d-block pb-2"
                                        style="max-width: 200px; padding-top: 23px">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="id" id="id" value="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tailor_name">Nama Tailor</label>
                                            <input type="text" class="form-control" placeholder="Nama tailor"
                                                name="tailor_name" id="tailor_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" placeholder="Email" name="email"
                                                id="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            <input type="text" class="form-control" placeholder="Alamat" name="address"
                                                id="address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">No Hp</label>
                                            <input type="number" class="form-control" placeholder="no hp" name="phone"
                                                id="phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group fill">
                                    <label for="gambar">Gambar</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="tailor_img" name="tailor_img">
                                        <label class="custom-file-label" for="gambar" id="tailor-label">Upload
                                            gambar</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control" name="description" id="description" style="display: none;"></textarea>
                                    <div id="summernote"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" form="formTambah" class="btn btn-outline-primary">Submit Data</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal image --}}
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" style="max-width: 1024px" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="previewImage" src="" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('#summernote').summernote({
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onInit: function() {
                        var code = $(this).summernote('code');
                        $(this).summernote('code', code.replace(/<p>/gi, '').replace(/<\/p>/gi, '')
                            .replace(/<br>/gi, ''));
                    }
                }
            });

            var dataTable = $("#dataTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
            console.log(dataTable)
            $.ajax({
                type: "get",
                url: "{{ url('api/v1/tailor') }}",
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    let tableBody = '';
                    $.each(response.data, function(index, item) {
                        tableBody += "<tr>";
                        tableBody += "<td>" + (index + 1) + "</td>";
                        tableBody += "<td>" + item.tailor_name + "</td>";
                        tableBody += "<td>" + item.email + "</td>";
                        tableBody += "<td>" + item.address + "</td>";
                        tableBody += "<td>" + item.phone + "</td>";
                        tableBody += "<td><a class='openModal text-primary ' data-image='" +
                            item
                            .tailor_img +
                            "'><i class='far fa-eye d-flex text-lg justify-content-center'></i></a></td>";
                        tableBody += "<td>" + item.description + "</td>";
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

                    $(".openModal").on('click', function() {
                        var imgSrc = $(this).data('image');
                        $("#previewImage").attr("src", "{{ asset('uploads/tailor') }}/" +
                            imgSrc);
                        $("#imageModal").modal('show');
                    });
                },
                error: function() {
                    console.log("Failed to get data from the server");
                }
            });

            $(document).ready(function() {
                $(document).on('change', '#tailor_img', function() {
                    var fileName = $(this).val().split('\\').pop();
                    $('#tailor-label').text(fileName);
                });
            });


            $(document).ready(function() {
                $('#tailor_img').change(function() {
                    var fileInput = $(this)[0];
                    var imagePreview = $('#preview');
                    var file = fileInput.files[0];

                    if (file) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            imagePreview.attr('src', e.target.result);
                            imagePreview.show();
                        };

                        reader.readAsDataURL(file);
                    } else {
                        imagePreview.hide();
                    }
                });
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
                $('#TailorModal').modal('show');
            }

            $('#formTambah').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let id = $('#id').val();
                let description = $('#summernote').summernote('code');
                formData.append('description', description)
                console.log(description)
                console.log(formData)
                let url = isEditMode ? "{{ url('api/v1/tailor/update') }}/" + id :
                    "{{ url('api/v1/tailor/create') }}";
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
                $(document).on('change', '#tailor', function() {
                    let fileName = $(this).val().split('\\').pop();
                    $('#tailor-label').text(fileName);
                });
                $.ajax({
                    url: "{{ url('api/v1/tailor/get') }}/" + id,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data);
                        showModal(true);
                        $('#id').val(data.data.id);
                        $('#tailor_name').val(data.data.tailor_name);
                        $('#email').val(data.data.email);
                        $('#address').val(data.data.address);
                        $('#phone').val(data.data.phone);
                        $('#summernote').summernote('code', data.data.description);
                        $('#tailor_img').html(data.data.tailor_img);
                        $('#preview').attr('src', "{{ asset('uploads/tailor') }}/" + data.data
                            .tailor_img);
                        let fileName = data.data.tailor_img.split('/').pop();
                        $('#tailor-label').text(fileName);
                    },
                    error: function() {
                        alert("error");
                    }
                });
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
                            url: "{{ url('api/v1/tailor/delete') }}/" + id,
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
