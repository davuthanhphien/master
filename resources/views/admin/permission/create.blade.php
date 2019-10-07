@extends('admin.dashboard')

@section('content')

    <div class="col-md-8 ss">
        <div class="col-lg-12 mt-3" >
            <h1 class="page-header">Role
                <small>Thêm</small>
            </h1>
        </div>

        <form action="{{route('permission.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name"  />
            </div>
            <div class="form-group">
                <label>Description</label>
                <input class="form-control" name="description"  />
            </div>
            <button type="submit" class="btn btn-default">Thêm</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>


    </div>

@endsection
