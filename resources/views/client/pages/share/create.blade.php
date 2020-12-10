@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Đặt câu hỏi
@endsection
@push('css')
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@endpush
@section('content')
<!-- Page Content -->
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 o-giua">
        <form action="{{route('share.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <table class="table table-responsive borderless text-right">
                <tr>
                    <td>Chọn loại tin</td>
                    <td>
                        <input type="hidden" class="form-control" name="type" value="{{$type->type_id}}">
                        <input type="text" class="form-control"  value="{{$type->type_name}}">
                    </td>
                </tr>
                <tr>
                    <td>Chọn ảnh <red-star></red-star>
                    </td>
                    <td><img id="image" alt="Chọn hình đại diện" style="max-height: 185px;
                            float: left;
                            width: 230px;" src="https://via.placeholder.com/230x185" />

                </tr>
                <tr>
                    <td></td>
                    <td><label for="avatar" style="float: left">Chọn ảnh đại diện của tin...</label>
                        <input type="file" name="avatar" id="avatar" accept="image/*" style="display:none;"
                            onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                    </td>
                </tr>
                <tr>
                    <td style="white-space: nowrap;">Tiêu đề <red-star></red-star>
                    </td>
                    <td><input type="text" class="form-control" name="title" required>
                        <br></td>
                </tr>
                <tr>
                    <td style="white-space: nowrap;">Giá bán <red-star></red-star>
                    </td>
                    <td><input type="number" class="form-control" id="price" name="price" required min="0" step="any"
                            onKeyUp="if(this.value>1000000000){this.value='1000000000';}else if(this.value<0){this.value='0';}"
                            class="form-control input-transparent" value="0">
                        <br>
                        <div id="showPrice" style="float: left;color:red">Miễn phí</div>
                    </td>
                </tr>
                <tr>
                    <td style="white-space: nowrap;">Tên người bán <red-star></red-star>
                    </td>
                    <td><input type="text" class="form-control" name="name" required>
                        <br></td>
                </tr>
                <tr>
                    <td style="white-space: nowrap;">Số điện thoại liên lạc <red-star></red-star>
                    </td>
                    <td><input type="tel" class="form-control" name="phone" required>
                        <br></td>
                </tr>
                <tr>
                    <td style="white-space: nowrap;">Nội dung <red-star></red-star>
                    </td>
                    <td>
                        <textarea name="content" id="" class="tiny" cols="30" rows="20"></textarea>

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: left">
                        <button type="submit" class="btn btn-ctu">Đăng bài</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="col-md-1"></div>
    <!-- Blog Sidebar Column -->
    {{-- <aside class="col-md-3 sidebar-padding ben-phai">
        <div class="blog-sidebar">
            <div class="input-group searchbar">
                <input type="text" class="form-control searchbar" placeholder="Tìm kiếm...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Tìm kiếm</button>
                </span>
            </div><!-- /input-group -->
        </div>
        <!-- Blog Categories -->
        <div class="blog-sidebar">
            <h4 class="sidebar-title"><i class="fa fa-list-ul"></i> Học phần</h4>
            <hr>
            <ul class="sidebar-list">
                <li><a href="#">CT258 - Phát triển thương mại điện tử</a></li>
                <li><a href="#">CT255 - Nghiệp vụ thông minh</a></li>
                <li><a href="#">CT264 - Cơ sở dữ liệu phân tán</a></li>
                <li><a href="#">CT244 - Bảo trì phần mềm</a></li>
                <li><a href="#">CT236 - Quản trị cơ sở dữ liệu trên Windows</a></li>
            </ul>
        </div>
        <!-- Recent Posts -->
        <div class="blog-sidebar">
            <h4 class="sidebar-title"><i class="fa fa-align-left"></i> Bài viết đã xem</h4>
            <hr style="margin-bottom: 5px;">

            <div class="media">
                <a class="pull-left" href="#">
                    <img class="img-responsive media-object" src="{{asset('client/images/blog-photo1.jpg')}}"
                        alt="Media Object">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><a href="#">BI thi gì vậy mấy bạn?</a></h4>
                    Mọi người cho mình hỏi môn BI thầy nghe thi đề gì vậy
                </div>
            </div>

            <div class="media">
                <a class="pull-left" href="#">
                    <img class="img-responsive media-object" src="{{asset('client/images/blog2.jpg')}}"
                        alt="Media Object">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><a href="#">Post title 2</a></h4>
                    This is some sample text. This is some sample text. This is some sample text.
                </div>
            </div>

            <div class="media">
                <a class="pull-left" href="#">
                    <img class="img-responsive media-object" src="{{asset('client/images/blog3.jpg')}}"
                        alt="Media Object">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><a href="#">Post title 3</a></h4>
                    This is some sample text. This is some sample text. This is some sample text.
                </div>
            </div>
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="img-responsive media-object" src="{{asset('client/images/blog1.jpg')}}"
                        alt="Media Object">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><a href="#">Post title 4</a></h4>
                    This is some sample text. This is some sample text. This is some sample text.
                </div>
            </div>
        </div>
    </aside> --}}

</div>

@endsection
@push('script')
<script>
    $(document).ready(function(){
        $('#price').keyup(function(){
            var value=$(this).val();
            console.log(value);
            if(value!=0){

            value= parseFloat(value).toLocaleString('en-US');
            $('#showPrice').html(value+' đ');
            }
            else{

            $('#showPrice').val(0);
            $('#showPrice').html('Miễn phí');
            }
        });
    });
</script>
@endpush
