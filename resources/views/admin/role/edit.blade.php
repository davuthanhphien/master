@extends('admin.dashboard')

@section('content')

    <div class="col-md-8 ss">
        <div class="col-lg-12 mt-3" >
            <h1 class="page-header">Role</h1>
        </div>

        <form action="{{route('role.update',$role->id)}}" method="POST" id="editForm" >
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" value="{{$role->name}}"/>
            </div>
            <div class="form-group">
                <label>Permission : </label><br>
                @foreach($permission as $pm)
                    <input type="checkbox" value="{{$pm->id}}" name="checkPermission[]" aria-label="Checkbox for following text input" @if(in_array($pm->id,$arr_permissionId )) checked="checked" @endif> {{$pm->name}}
                @endforeach
            </div>

            <button type="submit" class="btn btn-default">Sửa</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>


    </div>

@endsection
