@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Chia sẻ
@endsection

@section('content')

<div class="row">
    <!-- Blog Column -->
    <div class="col-md-8">
        <h1 class="page-header sidebar-title">
            Chia sẻ
            <span style="float: right"><button class="btn btn-ctu"
                    onclick="window.location.href='{{route('share.create')}}'"> Thêm vật dụng chia sẻ</button> </span>
        </h1>
        <!--
                        First Blog Post -->
        <div class="row blogu">

            @forelse ($share as $item)
            <div class="col-md-3">

                <div class="card" style="width: 18rem;">
                    <a href="{{route('share.show',$item->item_slug)}}">
                        <img src="{{asset($item->item_avatar)}}" class="img-responsive card-img-top"
                            alt="{{asset($item->item_avatar)}}">
                    </a>
                    <span>{{$day[$item->item_id]}}</span>
                    <span style="float: right"><i class="fa fa-eye" aria-hidden="true"></i>
                        {{$item->item_view_count}}</i></span>
                    <div class="card-body">
                        <a href="{{route('share.show',$item->item_slug)}}">
                            <h4>{{$item->item_title}}</h4>
                        </a>
                        <ul style="    padding-left: 0px;">
                            <li>{{number_format($item->item_price)}} đ</li>
                            <li>{{$item->item_phone}}</li>
                            <li>{{$item->item_name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            @empty
            <h2 class="blog-title">Chưa có vật dụng nào được chia sẻ
            </h2>
            @endforelse
            {!!$share->links()!!}
        </div>
        <hr>



        
    </div>
    <!-- Blog Sidebar Column -->
<aside class="col-md-4 sidebar-padding">
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
                <h4 class="media-heading"><a href="{{route('share.show',$item->item_slug)}}">{{ $item->item_title }}</a></h4>
                <span><a href="#">{{ $item->item_name }}</a></span>
                <br>
                <span>{{ date('d/m/Y', strtotime($item->item_created)) }}</span>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Recent Posts -->
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
                    <h4 class="media-heading"><a href="{{route('share.show',$item->item_slug)}}">{{ $item->item_title }}</a></h4>
                    <span><a href="#">{{ $item->item_name }}</a></span>
                </div>
            </div>
            @endforeach
        @endif

    </div>

</aside>
</div>

@endsection
@push('script')
@endpush
