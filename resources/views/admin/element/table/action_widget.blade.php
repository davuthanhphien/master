@if (isset($widgets))

    <a href="{{ route('widgets.edit', $widgets->id) }}" class="btn btn-info">sửa</a>

    <form action="{{route('widgets.destroy',$widgets->id)}}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-info" type="submit" >Delete</button>
    </form>
    <a href="{{route('widgets.show',$widgets->id)}}" class="btn btn-info">show</a>

@endif
