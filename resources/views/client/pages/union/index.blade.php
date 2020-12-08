@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Chi Hội
@endsection
@push('css')
<style>
    .delete-blog {
        float: right;
    }

    .btn {
        padding: 6px 10px;
    }
</style>
@endpush
@section('content')

<div class="row">
    <!-- Blog Column -->
    <div class="col-md-8 ben-trai">
        <h1 class="page-header sidebar-title">
            CHI HỘI SINH VIÊN
            @if ($lcht == Auth::guard('student')->id())
            <span style="float: right"><button class="btn btn-ctu"
                    onclick="window.location.href='{{route('union.create')}}'"> Thêm bài viết</button> </span>
                    @endif
                <marquee scrolldelay="1" scrollamount="5">
                <span class="gioithiu">
                    Đây là nơi kết nối các bạn cùng quê với nhau, Tổ chức các buổi hoạt động ngoại khóa, Giúp đỡ và hộ
                    trợ các bạn trong quá trình học tập cũng như trong cuộc sống.
                </span>
            </marquee>
        </h1>
        <!--
                        First Blog Post -->
        <div class="row blogu">
            {{-- {{dd($blog)}} --}}
            @forelse ($blog as $item)
            <div class="col-md-12">

                <div class="col-sm-4 col-md-4 ">
                    <div class="blog-thumb">
                        <a href="{{route('union.show',$item->up_slug)}}">
                            <img class="img-responsive" src="{{asset($item->up_avatar)}}" alt="photo">
                        </a>
                    </div>
                </div>
                <div class="col-sm-8 col-md-8">


                    <h2 class="blog-title">
                        <a href="{{route('union.show',$item->up_slug)}}">{{$item->up_title}}</a>
                        <span class="comments-padding"></span>
                        @if($item->stu_id==Auth::id())
                        <a href="{{ route('union.delete', ['id'=>$item->up_id]) }}" id="deleteblog" class="delete-blog"
                            title="Xóa"><i class="fa fa-trash"></i></a>
                        @endif
                    </h2>
                    <p>

                        <i class="fa fa-calendar-o"></i> {{$item->ngaydang}}
                        <span class="comments-padding"></span>
                        <i class="fa fa-eye" aria-hidden="true"></i> {{$item->up_view_count}}</i>
                        <span class="comments-padding"></span>
                        <i class="fa fa-user" aria-hidden="true"></i>Đăng bởi: {{$item->stu_name}}</i>
                    </p>
                </div>
            </div>
            <div class="col-md-12">&nbsp;</div>
            @empty
            <h2 class="blog-title">Chưa có bài viết nào
            </h2>

            @endforelse
            @if ($blog!=[])

            {!!$blog->links()!!}
            @endif
        </div>
        <hr>




    </div>
    <div class="col-md-1 clear-center"></div>
    <!-- Blog Sidebar Column -->
    <aside class="col-md-3 sidebar-padding ben-phai">
        <div class="blog-sidebar">
            <div class="input-group searchbar">
                <input type="text" class="form-control searchbar" placeholder="Nhập từ khóa cần tìm">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Tìm kiếm</button>
                </span>
            </div><!-- /input-group -->
        </div>
        <!-- Blog Categories -->
        <div class="blog-sidebar">
            <h4 class="sidebar-title"><i class="fa fa-list-ul"></i> {{$ub_branch->ub_name}} </h4>
            <hr>
            <ul class="sidebar-list">
                <li><a href="#">
                    {{-- {{dd($chihoi)}} --}}
                    @foreach ($chihoi as $val)
                        @if ($val->sub_role == 'LCHT')
                        Chi hội trưởng: &nbsp; {{$val->stu_name}}

                        @endif
                    @endforeach
                </a></li>
                <li><a href="#">
                    @foreach ($chihoi as $val)
                        @if ($val->sub_role == 'LCHP')
                        Chi hội Phó: &nbsp; {{$val->stu_name}}

                        @endif
                    @endforeach
                </a></li>
                <li><a href="#">
                    @foreach ($chihoi as $val)
                        @if ($val->sub_role == 'UV')
                        Ủy viên: &nbsp; {{$val->stu_name}}

                        @endif
                    @endforeach
                </a></li>
                <li><a href="#">
                    Số lương hội viên: {{count($chihoi)}}
                </a></li>
                <li>
                    @if ($lcht == Auth::guard('student')->id())
                  <span><a href="{{ route('union-list-member', ['id'=>$ub_branch->ub_id]) }}">Xem danh sách hội viên</a></span></li>
                            @endif

            </ul>
        </div>
    </aside>
</div>

@endsection
@push('script')
<script>
    $('#deleteblog').click(function () {

        if(confirm('Bạn có muốn xóa ?')){
            return true;
        }
        else{
            return false;
        }
    });

</script>
@endpush
