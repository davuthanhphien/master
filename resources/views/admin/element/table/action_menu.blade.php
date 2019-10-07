@if (isset($menu))

    <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-info">sửa</a>

    <form action="{{route('menu.destroy',$menu->id)}}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-info" type="submit" >Delete</button>
    </form>
    <a href="{{route('menu.show',$menu->id)}}" class="btn btn-info">show</a>

@endif
