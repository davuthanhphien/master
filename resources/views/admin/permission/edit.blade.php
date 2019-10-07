@extends('admin.dashboard')

@section('content')

    <div class="col-md-8 ss">
        <div class="col-lg-12 mt-3" >
            <h1 class="page-header">Permission</h1>
        </div>

        <form action="{{route('permission.update',$permission->id)}}" method="POST" >
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" value="{{$permission->name}}"/>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input class="form-control" name="description" value="{{$permission->description}}"/>
            </div>


            <button type="submit" class="btn btn-default">Sửa</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>


    </div>

@endsection
