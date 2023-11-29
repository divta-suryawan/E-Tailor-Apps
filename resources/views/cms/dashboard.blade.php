@extends('../layouts/base')
@section('main-content')
    <div class="row">
        <div class="col-lg-6 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 id="tailor"></h3>
                    <p>Data Tailor</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-6 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3 id="boking"></h3>
                    <p>Data Boking</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat datang di dashboard E-Tailor
                                <b>{{ auth()->user()->name }}</b> 🎉
                            </h5>
                            <p class="mb-4"></b></p>
                            <i class="fa-sharp fa-solid fa-face-smile text-warning"></i>
                            <a href="javascript:;" class="">Enjoy your work !!!</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img class="mb-4 " src="{{ asset('assets/images/dashboard.svg') }}" height="300" width=350>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: "get",
                url: "{{ url('v1/dashboard/count') }}",
                dataType: "JSON",
                success: function(response) {
                    console.log(response)
                    $('#tailor').text(response.data)
                }
            });
            $.ajax({
                type: "get",
                url: "{{ url('v1/dashboard/count/boking') }}",
                dataType: "JSON",
                success: function(response) {
                    console.log(response)
                    $('#boking').text(response.data)
                }
            });
        });
    </script>
@endsection
