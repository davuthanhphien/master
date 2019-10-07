@if (isset($banner))

    <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-info">sửa</a>

    <form action="{{route('banner.destroy',$banner->id)}}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-info" type="submit" >Delete</button>
    </form>
    <a href="{{route('banner.show',$banner->id)}}" class="btn btn-info">show</a>

@endif
