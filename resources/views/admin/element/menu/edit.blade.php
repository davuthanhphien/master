@extends('admin.dashboard')
@section('content')
    <?php
        $menus = \App\Menu::pluck('name_vi','id');
    ?>
    <div class="col-md-8 ss">
        <div class="col-lg-12 mt-3" >
            <h1 class="page-header">Menu
                <small>Sửa</small>
            </h1>
        </div>
        <form action="{{route('menu.update',$menu->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name_vi" value="{{$menu->name_vi}}" />
            </div>
            <div class="form-group">
                <label>Location</label>
                <input class="form-control" name="location" value="{{$menu->location}}" />
            </div>
            <div class="form-group">
                <label>Order_no</label>
                <input class="form-control" name="order_no" value="{{$menu->order_no}}" />
            </div>
            <div class="form-group">
                <label>Parent_id</label>
                <select class="form-control select2" name="parent_id" >
                    @foreach($menus as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                    @endforeach
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
