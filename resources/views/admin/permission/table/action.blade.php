@if (isset($permission))

    <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-info">Edit</a>

    <form action="{{route('permission.destroy',$permission->id)}}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-info" type="submit" >Delete</button>
    </form>
@endif
