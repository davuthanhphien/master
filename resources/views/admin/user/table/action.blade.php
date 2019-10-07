@if (isset($user))

    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info">sửa</a>

    <form action="{{route('user.destroy',$user->id)}}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-info" type="submit" >Delete</button>
    </form>
    <a href="{{route('user.show',$user->id)}}" class="btn btn-info">show</a>

@endif
