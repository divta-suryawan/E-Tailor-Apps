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
                
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="dataTables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="dataTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>nama</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    
                                    <tr id="loading-row" style="display: none;">
                                        <td colspan="9" class="text-center">
                                            <i class="fa fa-spinner fa-spin"></i> Loading...
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

@endsection
