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
    .tox.tox-tinymce.tox-tinymce--toolbar-sticky-off {
    height: 200px !important;
}
</style>
@endpush
@section('content')

<!-- Page Content -->
<div class="container singlepost">
    {{-- {{dd($post)}} --}}
    <div class="row">
        <article class="col-md-8 ben-trai">
            <a href="{{url()->previous()}}" class="btn btn-primary" style="color: white;">
                Quay lại
            </a>
            <h1 class="page-header sidebar-title">{{ $post->cp_title}}</h1>
            {{-- <img src="{{asset('client/images/unsplash1.jpg')}}" class="img-responsive" alt="photo" /> --}}
            {{-- <hr> --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="entry-meta">
                        <span><i class="fa fa-calendar-o"></i> {{$day}}</span>
                        <span><i class="fa fa-user"></i> Bởi {{$post->cs_role}} -<a href="#">
                                {{$post->stu_name}}</a></span>
                        <div class="pull-right">
                            <span><i class="fa fa-eye"></i> {{$post->cp_view_count}}</span>
                            <a href="#" data-cp_id=" {{$post->cp_id}} " id="GetPostId" data-toggle="modal" data-target="#CapNhatPost" style="font-size:14px !important;"><i class="fa fa-edit"></i>   Sửa bài viêt</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 dinh_dang_text">
                    <p>{!!$post->cp_content!!}</p>
                </div>
                <div class="col-md-12">
                    <img src="{{asset($post->cp_avatar)}}" alt="" width="100%;">
                </div>
                <div class="col-md-12">
                    <div class="comments1">
                        <div class="well">
                            <h4>Bình luận:</h4>
                            <form action="{{ route('club.comment.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="st_id" value="{{ Auth::guard('student')->id()}}">
                                <input type="hidden" name="cp_id" value="{{$post->cp_id}}">
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
                        @if ($val->com_idrep == null && $val->cp_id == $post->cp_id)
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="{{asset($val->stu_avatar)}}" alt="{{$val->username}}">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$val->com_content}}
                                    <small class="pull-right">
                                        {{date('d-m-Y H:m', strtotime($val->com_created))}}</small>
                                </h4>
                                {{$val->stu_name}}

                                <div class="row cm_icon">
                                    <div class="col-md-6">
                                        <div class="_cm_left">

                                            <a class="click_like" data-com_id="{!! $val->com_id!!}" title="Thích"><i
                                                    class="fa fa-thumbs-up icon" aria-hidden="true"></i></a>



                                            <a title="Bình luận" class="showform" data-id="{!! $val->cp_id!!}"><i
                                                    class="fa fa-comments" aria-hidden="true"></i></a>
                                            <input type="hidden" class="get_stu{!! $val->com_id!!}"
                                                value="{!! $val->stu_id!!}">
                                            <a href="#" title="Báo cáo" data-toggle="modal" data-target="#report"
                                                data-modal="{!! $val->com_id!!}" class="clickModal"><i
                                                    class="fa fa-flag"></i></a>


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
                                                                <h5 class="modal-title" id="exampleModalLabel">Thông báo
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn có thất sự muốn xóa?
                                                            </div>
                                                            <div class="modal-footer">

                                                                <form action="{{ route('share.comment.destroy') }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="com_id"
                                                                        value="{!! $val->com_id!!}">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Đóng</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Xóa</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                                    id="dropdown-menu2">
                                                    <a class="dropdown-item" data-toggle="modal"
                                                        data-target="#delete">Xóa bình luận</a>
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
                                        <img class="media-object" src="{{asset($val1->stu_avatar)}}"
                                            alt="{{$val1->username}}">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{$val1->com_content}}
                                            <small class="pull-right">
                                                {{date('d-m-Y H:m', strtotime($val1->com_created))}}</small>
                                        </h4>
                                        {{$val1->stu_name}}
                                        {{$val1->com_content}}
                                        <div class="row cm_icon">
                                            <div class="col-md-6">
                                                <div class="_cm_left">
                                                    <a href="#" title="Thích"><i class="fa fa-thumbs-up"
                                                            aria-hidden="true"></i></a>
                                                    {{-- <a title="Bình luận" class="showform" data-id="{!! $val->cp_id!!}" ><i class="fa fa-comments" aria-hidden="true"></i></a> --}}
                                                    <a href="#" title="Báo cáo" data-toggle="modal"
                                                        data-target="#report" data-modal="{{$val1->com_id}}"
                                                        class="clickModal"><i class="fa fa-flag"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="_cm_right" id="dropdown-menu3">
                                                    @if ($val1->stu_id == Auth::guard('student')->id())
                                                    {{-- <a href="" class="pull-right" title="Xóa bình luận"><i
                                                                class="fa fa-trash "></i></a> --}}
                                                    <a class="pull-right" id="dropdownMenuButton1"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">...</a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1"
                                                        id="dropdown-menu4">
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#delete1">Xóa bình luận</a>
                                                    </div>
                                                    <div class="modal fade" id="delete1" tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Thông
                                                                        báo</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Bạn có thất sự muốn xóa?
                                                                </div>
                                                                <div class="modal-footer">

                                                                    <form action="{{ route('comment.destroy') }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="com_id"
                                                                            value="{!! $val1->com_id!!}">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Đóng</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Xóa</button>
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
                                <div class="form-comment showrep" id="showrep{!!$val->cp_id!!}">
                                    <form action="{{ route('club.comment.rep') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="com_id" value="{!! $val->com_id!!}">
                                            <input type="hidden" name="st_id" value="{{ Auth::guard('student')->id()}}">
                                            <input type="hidden" name="cp_id" value="{{$post->cp_id}}">
                                            <textarea class="form-control rep_com" rows="1"
                                                name="com_repcontent"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Gửi</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach

                    </div>
                </div>
            </div>

        </article>
        {{-- @include('client.pages.club.sidebar') --}}
        {{-- Phần này của phụng chỉnh lại theo yêu cầu Của Đức --}}
        <aside class="col-md-4 sidebar-padding">
            <div id="app">
                <chat-layout></chat-layout>
            </div>
            {{-- @include('client.pages.club.search') --}}
            <!-- Blog Categories -->
            <div class="blog-sidebar">
                <h4 class="sidebar-title"><i class="fa fa-list-ul"></i> {{$post->c_name}}</h4>
                <hr>
                <ul class="sidebar-list">
                    <li><a href="">Chủ nhiệm CLB: &nbsp; &nbsp;
                            @foreach ($studentJoinClub as $vl)
                            @if( $vl->cs_role=='CNCLB')
                            <strong>{{$vl->stu_name}}</strong>
                            @endif
                            @endforeach
                        </a></li>
                    <li><a href="">Phó chủ nhiệm CLB:
                            @foreach ($studentJoinClub as $vl)
                            @if( $vl->cs_role=='PCNCLB')
                                &nbsp;<strong> {{$vl->stu_name}} </strong>&nbsp; &nbsp;,

                            @endif
                            @endforeach
                        </a></li>
                    {{-- <li><a href="#">Tổng số thành viên: {{ count($studentJoinClub  )}} thành viên</a></li>
                    <a class="btn btn-ctu" style="color: white;margin-top:5px;" data-toggle="collapse" href="#xemThem"
                        role="button">Xem thành viên</a>
                    <div class="collapse" id="xemThem">
                        <div class="card card-body">
                            <ul class="sidebar-list">
                                @foreach ($studentJoinClub as $vl)

                                <li>&nbsp;{{$vl->stu_name}} </li>

                                @endforeach
                            </ul>
                        </div>
                    </div> --}}
                    {{-- @foreach ($joined as $item)
                    @if ($item->cs_role!='YC'&&$item->cs_role!='TV')
                    <li class="btn-group">
                        <a class=" dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">{{$item->c_name}}
                    </a>
                    <div class="dropdown-menu" style="padding: 15px">
                        <a class="dropdown-item" href="{{route('club.clubPostSlug',$item->c_slug)}}">Xem bài
                            viết</a><br>
                        <a class="dropdown-item" href="{{route('club.listMember',$item->c_slug)}}">Danh sách thành
                            viên</a><br>
                        <a class="dropdown-item" href="{{route('club.listRequest',$item->c_slug)}}">Danh sách yêu
                            cầu</a><br>
                    </div>
                    </li>
                    @else

                    <li><a href="{{route('club.clubPostSlug',$item->c_slug)}}">{{$item->c_name}}</a></li>
                    @endif
                    @endforeach --}}
                </ul>
            </div>
            <!-- Recent Posts -->
            {{-- <div class="blog-sidebar">
                <h4 class="sidebar-title"><i class="fa fa-align-left"></i> Bài viết đã xem</h4>
                <hr style="margin-bottom: 5px;"> --}}
            {{-- {{dd($joined)}} --}}
            {{-- @foreach ($viewed as $item)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="img-responsive media-object" src="{{asset($item->cp_avatar)}}" alt="Media Object">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><a href="{{route('club.show',$item->cp_slug)}}">{{$item->cp_title}}</a></h4>
            </div>
            @endforeach
    </div> --}}


    {{-- </div> --}}


    </aside>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="CapNhatPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cập nhật bài viết</h5>
          </button>
        </div>
        <form action="{{ route('club.update.submit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">    
               <div class="content_form" style="width:490px">
                    <div class="form-group">
                      <label for="">Tiêu đề</label>
                      <input type="text"
                        class="form-control" name="cptitle" id="TieuDeCP" >
                      <input type="hidden"
                        name="cp11_id" id="CP1_ID" >
                    </div>
                    <div class="form-group">
                      <label for="">Hình ảnh</label>
                      <input type="file"
                        class="form-control" name="cpavatar"  >
                    
                    </div>
                    <div class="form-group">
                      <label for="">Nội dung</label>
                      <textarea name="cpcontent" id="NoiDungCP" class="tiny" ></textarea>
                    </div>
               </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
              <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@push('script')
<script>
    $(document).ready(function () {


        $('#GetPostId').click(function () { 
            var cp_id = $(this).attr('data-cp_id');
            console.log(cp_id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: " {{route('club.AjaxGetValue')}} ",
                data: {cp_id:cp_id},
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    $('#TieuDeCP').val(response.cp_title);
                    $('#CP1_ID').val(cp_id);
                    tinyMCE.activeEditor.setContent(response.cp_content);

                }
            });

        });




        //bình luận nè
        $(".showrep").hide();
          $('.showform').click(function () {
            //   console.log("ok");
            var id = $(this).attr('data-id');
            //   console.log(id);
            $("#showrep"+id).toggle();

          });

      });
</script>
@endpush
