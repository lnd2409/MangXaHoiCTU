@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Đặt câu hỏi
@endsection
@push('css')
<style>
</style>
@endpush
@section('content')
<!-- Page Content -->
{{-- <section class="container blog"> --}}
    <div class="row">
      
        <div class="col-md-1"></div>
        <div class="col-md-10 o-giua">
            <h3 class="sidebar-title"> Bài viết Chi Hội</h3>
            <form action="{{route('union.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="union" value="{{$union->ub_id}}">
                <table class="table table-responsive borderless text-right">

                    <tr>
                        <td>Chọn ảnh<red-star></red-star>
                        </td>
                        <td><img id="image" alt="Chọn hình đại diện" style="max-height: 185px;
                            float: left;
                            width: 230px;" src="https://via.placeholder.com/230x185" />

                    </tr>

                    <tr>
                        <td></td>
                        <td><label for="avatar" style="float: left">Chọn ảnh đại diện của tin...</label>
                            <input type="file" name="avatar" id="avatar" accept="image/*" style="display:none;"
                                onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])" required>
                        </td>
                    </tr>
                    <tr>
                        <td style="white-space: nowrap;">Tiêu đề <red-star></red-star>
                        </td>
                        <td><input type="text" class="form-control" name="title" required>
                            <br></td>
                    </tr>
                    <br>

                    <tr>
                        <td style="white-space: nowrap;">Nội dung <red-star></red-star>
                        </td>
                        <td>
                            <textarea name="content" id="" class="tiny " cols="30" rows="20"></textarea>

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
        {{-- <aside class="col-md-4 sidebar-padding">
            <div class="blog-sidebar">
                <div class="input-group searchbar">
                    <input type="text" class="form-control searchbar" placeholder="Search for...">
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

            <div class="blog-sidebar">
                <h4 class="sidebar-title"><i class="fa fa-comments"></i> Recent Comments</h4>
                <hr style="margin-bottom: 5px;">
                <ul class="sidebar-list">
                    <li>
                        <h5 class="blog-title">Author Name</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore</p>
                    </li>
                    <li>
                        <h5 class="blog-title">Author Name</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore</p>
                    </li>
                    <li>
                        <h5 class="blog-title">Author Name</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore</p>
                    </li>
                </ul>
            </div>

        </aside> --}}
    </div>
{{-- </section> --}}

@endsection
@push('script')

@endpush
