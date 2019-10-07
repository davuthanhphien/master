@extends('admin.dashboard')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Table User</h3>
                    <h2><a href="{{route('user.create')}}">Create</a></h2>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6"></div>
                        </div>
                        <div class="row">

                            <div class="col-sm-12">
                                <table id="table-user" class="table table-bordered table-hover dataTable" role="grid"
                                       aria-describedby="example2_info" >
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending">Id
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Name
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Email
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            Email_create_at
                                        </th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>


        </div>
    </div>



    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#table-user').DataTable({
                    processing : true,
                    serverSide : true,
                    ajax : "{!!  route('userdata.getdata')  !!}",
                    columns : [
                        { data: 'id'},
                        { data: 'name'},
                        { data: 'email'},
                        { data: 'email_verified_at'},
                        { data: 'action'},
                    ]
                });
            });
        </script>
    @endpush
@endsection
