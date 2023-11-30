<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="{{ asset('assets/images/logo-e-tailor.svg') }}" alt="" style="width: 75px">
                <br>
                <span class="h3 " style="color: #CC636F;"><b>E-Tailor APP</b></span>
            </div>
            <div class="card-body">
                <div id="error-message" class="error-message" style="display: none;">Inputkan disini</div>
                <div id="success-message" class="success-message" style="display: none;"></div>
                <form id="loginForm" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" >Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
</body>

</html>

<script src="{{ asset('assets/sweetalert/script.js') }}"></script>

<script>
    $(document).ready(function() {
        var errorMessage = $('#error-message');
        var successMessage = $('#success-message');

        $('#loginForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ url('login') }}",
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response)
                    $('.form-control').removeClass('border-danger');
                    if (response.message === 'Check your validation') {
                        $.each(response.errors, function(field, error) {
                            const fieldName = field.split('.')[0];
                            const fieldIndex = field.split('.')[1];
                            const formElement = $(
                                `[name="${fieldName}[]"]:eq(${fieldIndex})`
                            );
                            formElement.addClass('border-danger');
                            $(`[name="${field}"]`).addClass(
                                'border-danger');
                        });
                    } else if (response.message === 'Login failed') {
                        alert('failed');
                    } else {
                        window.location.href = '/cms/dashboard';
                    }
                }
            });
        });

        function showErrorAlert(message) {
            $('#loading-overlay').hide();
            errorMessage.html(message);
        }


    });
</script>
