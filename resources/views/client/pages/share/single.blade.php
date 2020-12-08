@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Chi tiết bài viết
@endsection
@push('css')
<style>
    .page-header {
        border-bottom: 0px solid #eee;
    }

    table {
        border-collapse: collapse;
        margin: 0 auto;
    }

    table td {
        padding: 1rem;
        border: 1px solid #ddd;
    }

    table tr:first-child td {
        border-top: 0;
    }

    table tr td:first-child {
        border-left: 0;
    }

    table tr:last-child td {
        border-bottom: 0;
    }

    table tr td:last-child {
        border-right: 0;
    }

    th._info {
        font-size: 16px;
        /* text-align: center; */
        color: #ff7410;
        font-weight: 500;
        text-transform: capitalize;
    }

    #item_content>p {
        color: #ff7410;
        font-size: 18px;
        margin: -8px 0;
    }

    /* comment */
    .row.cm_icon {
        /* border: 1px solid; */
        margin-top: 14px;
    }

    .row.cm_icon ._cm_left a {
        margin: 0px 22px;
        font-size: 16px;
        display: inline-block;
        /* border: 1px solid; */
        width: 19px;
        padding: 0 10px;
        /* margin-left: -3px; */
    }

    ._cm_right>a {
        margin-right: 10px;
    }

    .form-comment {
        width: 100%;
        /* border: 1px solid; */
        margin-top: 10px;
    }

    .icon-color {
        color: #3571ad;

    }

    #dropdown-menu1 {
        position: relative;
    }

    div#dropdown-menu2 {
        position: absolute;
        top: -32px;
        left: 165px;
        padding: 5px;
        text-align: center;
    }

    div#dropdown-menu3 {
        position: relative;
    }

    div#dropdown-menu4 {
        position: absolute;
        top: -32px;
        left: 124px;
        text-align: center;
    }
</style>
@endpush
@section('breadcrumb')
<ul class="brcmp">
    <li>
        <a href="{{route('share')}}">Chia sẻ</a>
        <i>|</i>
    </li>
    <li><a href="{{route('share.type',$post->type_slug)}}">
            {{$post->type_name}}
        </a>

    </li>
</ul>
@endsection
@section('content')

<!-- Page Content -->
<div class="row">
    <div class="col-md-1"></div>
    <article class="col-md-10 o-giua">
        {{-- <hr> --}}
        <div class="row">
            <div class="col-smd-12">
                <h1 class="sidebar-title" style="width:100%;margin 20px;text-transform: uppercase;">{{$post->item_title}}</h1>
            </div>
            <div class="col-md-12">
                <div class="entry-meta">
                    <span><i class="fa fa-calendar-o"></i> {{$day}}</span>
                    <span><i class="fa fa-user"></i> Bởi <a
                            href="{{ route('Info',$post->stu_code.'.'.Str::slug($post->stu_name, '-')) }}">
                            {{$post->stu_name}}</a></span>
                    <div class="pull-right">
                        <span><i class="fa fa-eye"></i> {{$post->item_view_count}}</span>
                        <span><i class="fa fa-flag"></i><a href="#" title="Báo cáo" data-toggle="modal"
                                data-target="#report" data-modal="{!! $post->item_id!!}" class="clickModal"> Báo cáo
                            </a></span>
                        <span><i class="fa fa-trash"></i><a href="{{ route('share.delete', ['id'=> $post->item_id]) }}">
                                Xóa bài viết</a></span>
                    </div>
                    @include('client.pages.share.report')
                </div>
            </div>
        </div>
        <br>
        <img src="{{asset($post->item_avatar)}}" class="img-responsive" alt="photo"  style="width: 30%;margin-left: 133px;"/>

        <br>

        <div class="form-group" style="color: black; font-size:18px">
            <label>Chú thích:</label>
            <span id="item_content">{!!$post->item_content!!}</span>
        </div>
        <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <th scope="row">Giá bán:</th>
                    <th class="_info">{{$post->item_price==0? 'Miễn phí' :$post->item_price}}</th>
                </tr>
                <tr>
                    <th scope="row">Số điện thoại liên hệ:</th>
                    <th class="_info">{{$post->item_phone}}</th>
                </tr>
                <tr>
                    <th scope="row">Người đăng:</th>
                    <th class="_info">{{$post->item_name}}</th>
                </tr>
            </tbody>
        </table>
        {{-- {{dd($post)}} --}}
        <div class="comments1">
            <div class="well">
                <h4>Bình luận:</h4>
                <form action="{{ route('share.comment.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="st_id" value="{{ Auth::guard('student')->id()}}">
                    <input type="hidden" name="item_id" value="{{$post->item_id}}">
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="com_content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>
            {{-- Bình luận --}}
            {{-- {{dd($comment)}} --}}
            {{-- {{dd($like)}} --}}
            @foreach ($comment as $val)
            @if ($val->com_idrep == null && $val->item_id == $post->item_id)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{asset($val->stu_avatar)}}" alt="{{$val->username}}">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$val->com_content}}
                        <small class="pull-right"> {{date('d-m-Y H:m', strtotime($val->com_created))}}</small>
                    </h4>
                    {{$val->stu_name}}

                    <div class="row cm_icon">
                        <div class="col-md-6">
                            <div class="_cm_left">

                                <a class="click_like" data-com_id="{!! $val->com_id!!}" title="Thích"><i
                                        class="fa fa-thumbs-up icon" aria-hidden="true"></i></a>

                                {{-- <span id="show_count{!! $val->com_id!!}">
                                        {{$count_like[$val->com_id]==0 ? '' : $count_like[$val->com_id]}}</span> --}}


                                <a title="Bình luận" class="showform" data-id="{!! $val->com_id!!}"><i
                                        class="fa fa-comments" aria-hidden="true"></i></a>
                                <input type="hidden" class="get_stu{!! $val->com_id!!}" value="{!! $val->stu_id!!}">
                                <a href="#" title="Báo cáo" data-toggle="modal" data-target="#report"
                                    data-modal="{!! $val->com_id!!}" class="clickModal"><i class="fa fa-flag"></i></a>


                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="_cm_right">
                                @if ($val->stu_id == Auth::guard('student')->id())
                                <div class="dropdown" id="dropdown-menu1">

                                    <a class="pull-right" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">...</a>

                                    {{-- thông báo xóa bình luận --}}
                                    <div class="modal fade" id="delete" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                                                </div>
                                                <div class="modal-body">
                                                    Bạn có thất sự muốn xóa?
                                                </div>
                                                <div class="modal-footer">

                                                    <form action="{{ route('share.comment.destroy') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="com_id" value="{!! $val->com_id!!}">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary">Xóa</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="dropdown-menu2">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#delete">Xóa bình
                                            luận</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @foreach ($comment as $val1)
                    @if ($val->com_id ==$val1->com_idrep)
                    <div class="media" style="border-bottom:none;">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="{{asset($val1->stu_avatar)}}" alt="{{$val1->username}}">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$val1->com_content}}
                                <small class="pull-right">
                                    {{date('d-m-Y H:m', strtotime($val1->com_created))}}</small>
                            </h4>
                            {{$val1->stu_name}}
                            <div class="row cm_icon">
                                <div class="col-md-6">
                                    <div class="_cm_left">
                                        <a href="#" title="Thích"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
                                        {{-- <a title="Bình luận" class="showform" data-id="{!! $val->com_id!!}" ><i class="fa fa-comments" aria-hidden="true"></i></a> --}}
                                        <a href="#" title="Báo cáo" data-toggle="modal" data-target="#report"
                                            data-modal="{{$val1->com_id}}" class="clickModal"><i
                                                class="fa fa-flag"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="_cm_right" id="dropdown-menu3">
                                        @if ($val1->stu_id == Auth::guard('student')->id())
                                        {{-- <a href="" class="pull-right" title="Xóa bình luận"><i
                                                    class="fa fa-trash "></i></a> --}}
                                        <a class="pull-right" id="dropdownMenuButton1" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">...</a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1"
                                            id="dropdown-menu4">
                                            <a class="dropdown-item" data-toggle="modal" data-target="#delete1">Xóa bình
                                                luận</a>
                                        </div>
                                        <div class="modal fade" id="delete1" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        Bạn có thất sự muốn xóa?
                                                    </div>
                                                    <div class="modal-footer">

                                                        <form action="{{ route('comment.destroy') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="com_id"
                                                                value="{!! $val1->com_id!!}">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Đóng</button>
                                                            <button type="submit" class="btn btn-primary">Xóa</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <div class="form-comment showrep" id="showrep{!! $val->com_id!!}">
                        <form action="{{ route('share.comment.store.rep') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="com_id" value="{!! $val->com_id!!}">
                                <input type="hidden" name="st_id" value="{{ Auth::guard('student')->id()}}">
                                <input type="hidden" name="item_id" value="{{$post->item_id}}">
                                <textarea class="form-control rep_com" rows="1" name="com_repcontent"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @endforeach

        </div>
    </article>
    <div class="col-md-1"></div>
    <div class="col-md-1 clear-center"></div>
    <!-- Blog Sidebar Column -->
    {{-- <aside class="col-md-3 sidebar-padding ben-phai">
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
            <h4 class="sidebar-title"><i class="fa fa-list-ul"></i> Bài chia sẻ gần đây</h4>
            <hr>
            @foreach ($lastedPost as $item)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="img-responsive media-object" src="{{asset('client/images/blog-photo1.jpg')}}"
                        alt="Media Object">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><a
                            href="{{route('share.show',$item->item_slug)}}">{{ $item->item_title }}</a></h4>
                    <span><a href="#">{{ $item->item_name }}</a></span>
                    <br>
                    <span>{{ date('d/m/Y', strtotime($item->item_created)) }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="blog-sidebar">
            <h4 class="sidebar-title"><i class="fa fa-align-left"></i> Bài viết đã xem</h4>
            <hr style="margin-bottom: 5px;">
            @if ($baivietdaxem)
            @foreach ($baivietdaxem as $item)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="img-responsive media-object" src="{{asset('client/images/blog-photo1.jpg')}}"
                        alt="Media Object">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><a
                            href="{{route('share.show',$item->item_slug)}}">{{ $item->item_title }}</a></h4>
                    <span><a href="#">{{ $item->item_name }}</a></span>
                </div>
            </div>
            @endforeach
            @endif --}}


            {{-- show ra hình --}}
    <div id="myModal" class="modal" aria-hidden="true" tabindex="-1" role="dialog">


        <img class="modal-content" id="img01">


    </div>
</div>

@endsection
@push('script')
<script>
    $(document).ready(function () {


        //bình luận nè
        $(".showrep").hide();
          $('.showform').click(function () {
            //   console.log("ok");
            var id = $(this).attr('data-id');
            //   console.log(id);
            $("#showrep"+id).toggle();

          });


        $('#xoabaiviet').click(function (e) {
            if(confirm('Bạn có muốn xóa !')){
                return true;
            }
            return false;
            e.preventDefault();
        });

      });
</script>
@endpush
