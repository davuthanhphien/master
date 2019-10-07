@extends('admin.dashboard')
@section('content')
    <div class="col-md-8 ss">
        <div class="col-lg-12 mt-3" >
            <h1 class="page-header">Widget
                <small>Sửa</small>
            </h1>
        </div>
        <form action="{{route('widgets.update',$widgets->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name_vi" value="{{$widgets->name_vi}}" />
            </div>
            <div class="form-group">
                <label>Location</label>
                <input class="form-control" name="location" value="{{$widgets->location}}" />
            </div>
            <div class="form-group">
                <label>Order_no</label>
                <input class="form-control" name="order_no" value="{{$widgets->order_no}}" />
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="0" @if($widgets->status == 0) selected @endif>0</option>
                    <option value="1"@if($widgets->status == 1) selected @endif>1</option>
                </select>
            </div>
            <button type="submit" class="btn btn-default">Sửa</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>


    </div>
    @push('scripts')
        <script type="text/javascript">
            $('.select2').select2();
        </script>
    @endpush
@endsection
