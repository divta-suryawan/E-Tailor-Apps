@extends('../layouts/base')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Paket</h1>
        </div>
    </div>
@endsection
@section('main-content')
    <div class="col-12">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <button type="button" class="btn btn-outline-primary ml-auto" data-toggle="modal" data-target="#packageModal"
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
                                <th>Tailor/Toko</th>
                                <th>Nama Paket</th>
                                <th>Harga Paket</th>
                                <th>Gambar Paket</th>
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
    <div class="modal fade" id="packageModal" tabindex="-1" role="dialog" aria-labelledby="TailorLabel" aria-hidden="true">
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="id_tailor">Nama Tailor/Paket</label>
                                            <select name="id_tailor" id="id_tailor" class="form-control">
                                                <option value="" disabled selected>--pilih--</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="package_name">Nama Paket</label>
                                            <input type="text" class="form-control" placeholder="Nama paket" name="package_name"
                                                id="package_name">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                         <label for="package_price">Harga Paket(Rupiah)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="0" name="package_price" id="package_price">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group fill">
                                    <label for="gambar">Gambar</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="package_image" name="package_image">
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

            function formatRupiah(angka) {
                let numberString = angka.toString();
                let split = numberString.split('.');
                let sisa = split[0].length % 3;
                let rupiah = split[0].substr(0, sisa);
                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                return 'Rp. ' + rupiah;
            }

            function formatAngka(angka) {
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            $.ajax({
                type: "get",
                url: "{{ url('api/v1/packages') }}",
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    let tableBody = '';
                    $.each(response.data, function(index, item) {
                        tableBody += "<tr>";
                        tableBody += "<td>" + (index + 1) + "</td>";
                        tableBody += "<td>" + item.tailor.tailor_name + "</td>";
                        tableBody += "<td>" + item.package_name + "</td>";
                        tableBody += "<td>" + formatRupiah(item.package_price) + "</td>";
                        tableBody += "<td><a class='openModal text-primary ' data-image='" +
                            item
                            .package_image +
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
                        $("#previewImage").attr("src", "{{ asset('uploads/packages') }}/" +
                            imgSrc);
                        $("#imageModal").modal('show');
                    });
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

             $('#package_price').on('input', function () {
                let inputValue = $(this).val();

                inputValue = inputValue.replace(/[^\d]/g, '');
                $(this).val(formatAngka(inputValue));
            });

            $(document).ready(function() {
                $(document).on('change', '#package_image', function() {
                    var fileName = $(this).val().split('\\').pop();
                    $('#tailor-label').text(fileName);
                });
            });


            $(document).ready(function() {
                $('#package_image').change(function() {
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

            // get tailor name
            $.ajax({
                type: 'get',
                url: '/api/v1/tailor/',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    for (var i = 0; i < response.data.length; i++) {
                        $('#id_tailor').append('<option value="' + response.data[i].id + '">' + response.data[i].tailor_name + '</option>');
                    }
                },
                error: function(error) {
                    console.log('Error:', error);
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
                $('#packageModal').modal('show');
            }

            $('#formTambah').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let id = $('#id').val();
                let inputValue = $('#package_price').val();
                let numericValue = inputValue.replace(/[^\d]/g, '');
                formData.append('package_price', numericValue);
                let description = $('#summernote').summernote('code');
                formData.append('description', description)
                console.log(description)
                console.log(formData)
                let url = isEditMode ? "{{ url('api/v1/packages/update') }}/" + id :
                    "{{ url('api/v1/packages/create') }}";
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
                $(document).on('change', '#tailor', function() {
                    let fileName = $(this).val().split('\\').pop();
                    $('#tailor-label').text(fileName);
                });
                $.ajax({
                    url: "{{ url('api/v1/packages/get') }}/" + id,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data);
                        showModal(true);
                       $('#id').val(data.data.id);
                        $('#id_tailor').val(data.data.id_tailor);
                        $('#package_name').val(data.data.package_name);
                        $('#package_price').val(formatAngka(data.data.package_price));
                        $('#summernote').summernote('code', data.data.description);
                        $('#package_image').html(data.data.package_image);
                        $('#preview').attr('src', "{{ asset('uploads/packages') }}/" + data.data
                            .package_image);
                        let fileName = data.data.package_image.split('/').pop();
                        $('#tailor-label').text(fileName);
                    },
                    error: function() {
                        alert("error");
                    }
                });
            });

            function resetModal() {
                $('#id').val('');
                $('#id_tailor').val('');
                $('#package_name').val('');
                $('#package_price').val('');
                $('#description').val('');
                $('#package_image').val('');
                $('#summernote').summernote('code', '');
                $('#preview').attr('src', '').hide();
                $('#tailor-label').text('Upload gambar');
            }

            $('#packageModal').on('hidden.bs.modal', function() {
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
                            url: "{{ url('api/v1/packages/delete') }}/" + id,
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
