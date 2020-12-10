@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Chia sẻ
@endsection
@push('css')
<style>
    .style-color {
        font-size: 16px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        margin: 10px 0;
    }

    div#myModal {
        width: 65%;
        height: 500px;
        margin: 113px auto;
        margin-left: 359px;
    }

    .btn {
        padding: 6px 10px;
    }

    #close {
        font-size: 52px;
        margin-right: 134px;
        margin-top: -14px;
    }
</style>
@endpush
@section('content')

<div class="row">
    <!-- Blog Column -->
    <div class="col-md-8 ben-trai">
        <h1 class="page-header sidebar-title">
           {{$typeName->type_name}}
            <span style="float: right"><button class="btn btn-ctu"
                    onclick="window.location.href='{{route('share.create',['id'=> $typeName->type_id])}}'"> Thêm vật dụng chia sẻ</button> </span>
            <marquee scrolldelay="1" scrollamount="5">
                <span class="gioithiu">
                    Mời các bạn cùng nhau chia sẻ những vật dụng cá nhân: Tài liệu, bàn ghế, sách vở...
                </span>
            </marquee>
        </h1>
        <!--
                        First Blog Post -->
        <div class="row blogu">
            <div id="content">
                @forelse ($share as $item)
                <div class="col-md-4">
                    <div class="card" style="width: 20rem; border: 2px solid rgb(230, 215, 215); padding: 20px; background-color: white; height: auto;">
                        <img class="image" data-id="{!!$item->item_id!!}" id="myImg{!!$item->item_id!!}"
                            src="{{asset($item->item_avatar)}}" class="getimg" class="img-responsive card-img-top"
                            alt="{{asset($item->item_avatar)}}" style="width:100%;">
                        <div class="card-body">
                            <h5 class="card-title style-color" style="text-transform:unset; font-weight: bold;">{{$item->item_title}}
                            </h5>
                            <a href="{{route('share.show',$item->item_slug)}}" class="style-color"> Xem chi tiết...</a>
                            <span style="float: right"><i class="fa fa-eye" aria-hidden="true"></i>
                                {{$item->item_view_count}}</i></span>
                        </div>
                    </div>
                </div>
                {{-- </div>
        </div> --}}
                @empty
                <h2 class="blog-title" style="margin-left: 10px">Chưa có vật dụng nào được chia sẻ
                </h2>
                @endforelse
                {!!$share->links()!!}

            </div>


        </div>
        <hr>
    </div>
    <div class="col-md-1 clear-center"></div>
    <!-- Blog Sidebar Column -->
    <aside class="col-md-3 sidebar-padding ben-phai">
        @include('client.pages.share.search')
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
        {{-- </div> --}}
        <!-- Recent Posts -->
        <div class="blog-sidebar">
            <h4 class="sidebar-title"><i class="fa fa-align-left"></i> Bài viết đã xem</h4>
            <hr style="margin-bottom: 5px;">
            @if ($baivietdaxem)
            @foreach ($baivietdaxem as $item)
            <div class="media">
                <a class="pull-left" href="{{route('share.show',$item->item_slug)}}">
                    <img class="img-responsive media-object" src="{{asset('client/images/blog-photo1.jpg')}}"
                        alt="Media Object">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><a
                            href="{{route('share.show',$item->item_slug)}}">{{ $item->item_title }}</a>
                    </h4>
                    <span><a href="{{route('share.show',$item->item_slug)}}">{{ $item->item_name }}</a></span>
                </div>
            </div>
            @endforeach
            @endif

        </div>

    </aside>
    {{-- show ra hình --}}
    <div id="myModal" class="modal" aria-hidden="true" tabindex="-1" role="dialog">


        <img class="modal-content" id="img01">


    </div>
    {{-- @include('client.pages.share.right') --}}
</div>

@endsection
@push('script')
<script>
    $('.image').click(function (e) {
        e.preventDefault();
        var id =$(this).attr("data-id");
        // Get the modal
        ;

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("myImg"+id);
        var modalImg = document.getElementById("img01");
        $('#myModal').show();
        modalImg.src = this.src;



        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        // img.click(){
        //     $('#myModal').hidden();
        // }
        $('#img01').click(function (e) {
            e.preventDefault();
            // alert("tat");
            $('#myModal').hide();
        });
    });

</script>
@endpush
