@extends('admin.dashboard')

@section('content')

    <div class="col-md-8 ss">
        <div class="col-lg-12 mt-3" >
            <h1 class="page-header">User
                <small>{{$user->username}}</small>
            </h1>
        </div>

        <form action="{{route('user.update',$user->id)}}" method="POST" id="editForm" >
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" value="{{$user->name}}"/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" value="{{$user->email}}" />
            </div>
            <div class="form-group">
                <label>Role : </label><br>
                @foreach($role as $pm)
                    <input type="checkbox" value="{{$pm->id}}" name="checkRole[]" aria-label="Checkbox for following text input" @if(in_array($pm->id,$arr_roleId )) checked="checked" @endif> {{$pm->name}}
                @endforeach
            </div>


            <button type="submit" class="btn btn-default">Sửa</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>

    </div>

    @push('scripts')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
        {!! JsValidator::formRequest('App\Http\Requests\UserRequest', '#editForm'); !!}


    @endpush

@endsection
