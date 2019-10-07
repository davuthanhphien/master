@if (isset($role))

    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-info">Edit</a>

    <form action="{{route('role.destroy',$role->id)}}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-info" type="submit" >Delete</button>
    </form>
    <a href="{{route('role.show',$role->id)}}" class="btn btn-info">show</a>
@endif
