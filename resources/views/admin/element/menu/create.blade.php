@extends('admin.dashboard')
@section('content')
<?php
    $menu = \App\Menu::where('parent_id',null)->get();
?>
    <div class="col-md-8 ss">
        <div class="col-lg-12 mt-3" >
            <h1 class="page-header">Menu
                <small>Thêm</small>
            </h1>
        </div>
        <form action="{{route('menu.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name_vi"  />
            </div>
            <div class="form-group">
                <label>Location</label>
                <input class="form-control" name="location"  />
            </div>
            <div class="form-group">
                <label>Order_no</label>
                <input class="form-control" name="order_no"  />
            </div>
            <div class="form-group">
                <label>Parent_id</label>
                <select class="form-control" name="parent_id" >
                    @foreach($menu as $m)
                         {{$menuChilds = $m->childs}}
                        <option value="{{$m->id}}">{{$m->name_vi}}</option>
                    @if(isset($menuChilds) || count($menuChilds) > 0)
                        @foreach ($menuChilds as $mc)
                            <option value="{{$mc->id}}">--{{$mc->name_vi}}</option>
                        @endforeach
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-default">Thêm</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>


    </div>
@endsection
