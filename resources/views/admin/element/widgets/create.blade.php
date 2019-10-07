@extends('admin.dashboard')
@section('content')
    <div class="col-md-8 ss">
        <div class="col-lg-12 mt-3" >
            <h1 class="page-header">Widgets
                <small>Thêm</small>
            </h1>
        </div>
        <form action="{{route('widgets.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name_vi"  />
            </div>
            <div class="form-group">
                <label>Order_no</label>
                <input class="form-control" name="order_no"  />
            </div>
            <div class="form-group">
                <label>Location</label>
                <input class="form-control" name="location"  />
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="0">0</option>
                    <option value="1">1</option>
                </select>
            </div>
            <button type="submit" class="btn btn-default">Thêm</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>


    </div>
@endsection
