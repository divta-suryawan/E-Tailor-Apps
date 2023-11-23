@extends('layouts.base')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="ml-1">Data Booking</h1>
        </div>
    </div>
@endsection
@section('main-content')
    <div class="col-12">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h3 class="card-title">Data</h3>
                <button type="button" class="btn btn-outline-primary ml-auto"
                    id="addBooking">
                    Tambah Data
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataBooking" class="table table-bordered table-striped table-responsive-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Customer</th>
                                <th>No HP</th>
                                <th>Tanggal Booking</th>
                                <th>Tanggal Ketemu</th>
                                <th>Paket</th>
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
    {{-- modal upsert data --}}
    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="upsertData" method="POST" >
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="id" id="id" value="">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="customer_name">Nama Customer</label>
                                        <input type="text" class="form-control" placeholder="Input here.."
                                        name="customer_name" id="customer_name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone_number">No Hp</label>
                                        <input type="text" class="form-control" placeholder="Input here.."
                                        name="phone_number" id="phone_number">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="appointment_date">Tanggal Ketemu</label>
                                        <input type="date" class="form-control" placeholder="Input here.."
                                        name="appointment_date" id="appointment_date">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="id_package">Paket</label>
                                        <select name="id_package" id="id_package" class="form-control">
                                            <option value="" disabled selected>--pilih--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="button" id="saveBooking" class="btn btn-outline-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            let dataTable = $("#dataBooking").DataTable({
                "responsive": true,
                "lengthChange": true,
                "lengthMenu": [10, 20, 30, 40, 50],
                "autoWidth": false,
            });

            // get data booking
            function getDataBooking() {
                $.ajax({
                    url: `/api/v1/booking`,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        let tableBody = "";
                        $.each(response.data, function (index, item) {
                            const formattedBookingDate = moment(item.booking_date).format("D MMMM YYYY", { locale: 'id' });
                            const formattedAppointmentDate = moment(item.appointment_date).format("D MMMM YYYY", { locale: 'id' });

                            tableBody += "<tr>";
                            tableBody += "<td>" + (index + 1) + "</td>";
                            tableBody += "<td>" + item.customer_name + "</td>";
                            tableBody += "<td>" + item.phone_number + "</td>";
                            tableBody += "<td>" + item.booking_date + "</td>";
                            tableBody += "<td>" + formattedBookingDate + "</td>";
                            tableBody += "<td>" + formattedAppointmentDate + "</td>";
                            tableBody += "<td>";
                                tableBody += "<button type='button' class='btn btn-outline-primary btn-sm edit-modal' data-id='" + item.id + "'><i class='fa fa-edit'></i></button>";
                                tableBody += "<button type='button' class='btn btn-outline-danger btn-sm delete-confirm' data-id='" + item.id + "'><i class='fa fa-trash'></i></button>";
                            tableBody += "</td>";
                            tableBody += "</tr>";
                        });
                        let table = $("#dataBooking").DataTable();
                        table.clear().draw();
                        table.rows.add($(tableBody)).draw();
                    },
                    error: function () {
                    console.log("Failed to get data from the server");
                    }
                });
            }

            getDataBooking();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // get data packet
            function loadPackageOptions() {
                $.ajax({
                    url: '/api/v1/packages',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#id_package').empty();
                        $('#id_package').append($('<option>', {
                            value: '',
                            text: '--pilih--'
                        }));
                        $.each(response.data, function(index, package) {
                            $('#id_package').append($('<option>', {
                                value: package.id,
                                text: package.package_name
                            }));
                        });
                    },
                    error: function() {
                        console.log("Failed to load package data from the server");
                    }
                });
            }
            loadPackageOptions();

            // event edit data
            $(document).on('click', '.edit-modal', function() {
                let id = $(this).data('id');
                $('#bookingLabel').text('Edit Data');
                $.ajax({
                    type: 'GET',
                    url: `/api/v1/booking/get/${id}`,
                    success: function(response) {
                        $('#id').val(response.data.id);
                        $('#id_package').val(response.data.id_package);
                        $('#customer_name').val(response.data.customer_name);
                        $('#phone_number').val(response.data.phone_number);
                        $('#appointment_date').val(response.data.appointment_date);
                        $('#bookingModal').modal('show');
                    },
                    error: function(error) {
                        console.error('Gagal mengambil data', error);
                    }
                });
            });

            // event create data
            $(document).on('click', '#addBooking', function() {
                $('#bookingLabel').text('Tambah Data');
                $('#upsertData')[0].reset();
                $('#id').val('');
                $('#bookingModal').modal('show');
            });

            // alert
            function showSweetAlert(icon, title, message) {
                Swal.fire({
                    icon: icon,
                    title: title,
                    text: message
                });
            }

            //event create update data
            $(document).on('click', '#saveBooking', function(e) {
                e.preventDefault();
                let id = $('#id').val();
                let data = {
                    id : id,
                    customer_name : $('#customer_name').val(),
                    phone_number : $('#phone_number').val(),
                    appointment_date : $('#appointment_date').val(),
                    id_package : $('#id_package').val()
                };

                if (id) {
                    $.ajax({
                        type: 'post',
                        url: `/api/v1/booking/update/${id}`,
                        data: data,
                        success: function(response) {
                            if (response.code === 422) {
                               showSweetAlert('warning', 'Errors',response.errors)
                            } else if (response.code === 200) {
                                $('#bookingModal').modal('hide');
                                showSweetAlert('success', 'Success!', 'Data berhasil diperbaharui!');
                                window.location.reload();

                            }else {
                                showSweetAlert('error', 'Error!', 'Gagal memperbaharui data!')
                            }
                        },
                        error: function(xhr, status, error) {
                            showSweetAlert('error', 'Error!', 'Terjadi kesalahan!');
                        }
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/api/v1/booking/create',
                        data: data,
                        success: function(response) {
                            console.log(response);
                            if (response.code === 422) {
                               showSweetAlert('warning', 'Errors',response.errors)
                            } else if (response.code === 200) {
                                $('#leadershipModal').modal('hide');
                                showSweetAlert('success', 'Success!', 'Data berhasil ditambahkan!');
                                window.location.reload();
                            }else {
                                showSweetAlert('error', 'Error!', 'Gagal menambahkan data!');
                            }
                        },
                        error: function(xhr, status, error) {
                            showSweetAlert('error', 'Error!', 'Terjadi kesalahan!');
                        }
                    });
                }
            });


            // delete data
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
                            url: "{{ url('api/v1/booking/delete') }}/" + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id
                            },
                            success: function(response) {
                                if (response.message === 'Failed') {
                                    showSweetAlert('error','Gagal menghapus data',response.message);
                                } else {
                                    showSweetAlert('success', 'Success!', 'Data Berhasil Dihapus!');
                                    window.location.reload();
                                }
                            },
                            error: function(xhr, status, error) {
                                showSweetAlert('error', 'Error!', 'Terjadi kesalahan!');
                            },
                        });
                    }
                })
            });

        });
    </script>
@endsection
