@extends('admin.dashboard')
@section('content')
    <div class="col-md-8 ss">
        <div class="col-lg-12 mt-3" >
            <h1 class="page-header">Menu
                <small>Sửa</small>
            </h1>
        </div>
        <form action="{{route('banner.update',$banner->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name_vi"  value="{{$banner->name_vi}}"/>
            </div>
            <div class="form-group">
                <label>Location</label>
                <input class="form-control" name="location"  value="{{$banner->location}}"/>
            </div>
            <div class="form-group">
                <label>Order_no</label>
                <input class="form-control" name="order_no"  value="{{$banner->order_no}}"/>
            </div>
            <div class="avatar form-group">
                <label>Images</label><br>
                <img id="avatar" width="150px" src="/images/{{$banner->image}}">
                <br>
                <a class="change-avatar" href="#" style="cursor: pointer;color: #0a90eb">Chọn</a>
                <input style="margin-top: 20px" onchange="changeImg(this);" id="file" type="file" class="hidden" name="image">
            </div>

            <button type="submit" class="btn btn-default">Sửa</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>


    </div>
    @push('scripts')
        <script>
            $(document).on('click', '.change-avatar', function (e) {
                e.preventDefault();
                $('#file').click();
            });
            function changeImg(input) {
                //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    //Sự kiện file đã được load vào website
                    console.log(reader);
                    reader.onload = function (e) {
                        //Thay đổi đường dẫn ảnh
                        $('#avatar').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection
