@extends('admin.dashboard')

@section('content')

    <div class="col-md-12 ss">
        <div class="col-lg-12 mt-3">
            <h1 class="page-header">Role
                <small>Thêm</small>
            </h1>
        </div>

        <form action="{{route('role.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" name="name"/>
                    </div>
                    <div class="form-group">
                        <label>full</label>
                        <input class="form-control" name="full"/>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <table id="table-permission" class="table table-bordered table-hover dataTable" role="grid"
                           aria-describedby="example2_info">
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
                                colspan="1" aria-label="Browser: activate to sort column ascending">Description
                            </th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <button type="submit" class="btn btn-default">Thêm</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>


    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#table-permission').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{!!  route('permission.getdata')  !!}",
                    columns: [
                        {data: 'id'},
                        {data: 'name'},
                        {data: 'description'},
                        {data: 'action'},
                    ]
                });
            });
        </script>
    @endpush
@endsection
