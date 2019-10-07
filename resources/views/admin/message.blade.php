
    <div style="margin: 20px 0" >
        @if (count($errors) > 0 )
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
            </div>
        @endif
        @if (session('message'))
            <div class="aler alert-success">
                {{session('message')}}
            </div>
        @endif
    </div>

