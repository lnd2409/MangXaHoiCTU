@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Môn học -
    {{ $subject->sub_name }}
@endsection

@section('content')
<!-- Page Content -->
<div class="row">
    <!-- Blog Column -->
    <div class="col-md-12">
        <a href="{{ route('forum') }}">Quay lại</a>
    </div>
    <div class="col-md-8">
        <h1 class="page-header sidebar-title">
                {{ $subject->sub_name }}
        </h1>
        <!--
                        First Blog Post -->
        <div class="row blogu">
            <div class="col-sm-12 col-md-12">
                {{-- {{dd($blog)}} --}}
                @foreach ($postSubject as $item)
                <h2 class="blog-title">
                    <a href="{{route('forum.show',$item->p_slug)}}">{{$item->p_title}}</a>
                </h2>
                <p>
                    <b>Người viết:</b> <a href="#">{{ $item->stu_name }}</a>
                    <span class="comments-padding"></span>
                    <i class="fa fa-calendar-o"></i> {{ $day[$item->p_id] --}}
                </p>

                <hr>
                @endforeach
                {{-- {!!$blog->links()!!} --}}
            </div>
        </div>



    </div>

    <!-- Blog Sidebar Column -->
    <aside class="col-md-4 sidebar-padding">
        <div id="app">
            <chat-layout></chat-layout>
        </div>
        {{-- <script type="text/javascript" src="{{ asset('js/app.js') }}"></script> --}}
        <div class="blog-sidebar">
            <div class="input-group searchbar">
                <input type="text" class="form-control searchbar" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Tìm kiếm</button>
                </span>
            </div><!-- /input-group -->
        </div>
        <!-- Recent Posts -->
        <div class="blog-sidebar">
            <h4 class="sidebar-title"><i class="fa fa-align-left"></i> Thông tin môn học</h4>
            <div class="media">
                <div class="media-body">
                    <h4 class="media-heading"><a href="#">{{ $subject->sub_name }}</a></h4>
                    <h5 style="color: black;">Mã môn: <b>{{ $subject->sub_code }}</b></h5>
                    <h5 style="color: black;">{{ $subject->semester_name }}</h5>
                    <h5 style="color: black;">Năm học: {{ $subject->school_year_name }}</h5>
                </div>
            </div>
        </div>
        <div class="blog-sidebar">
            <h4 class="sidebar-title"><i class="fa fa-align-left"></i> Bài viết đã xem</h4>
            <hr style="margin-bottom: 5px;">
            {{-- {{dd($baivietdaxem)}} --}}
            @foreach ($baivietdaxem as $item)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="img-responsive media-object" src="{{asset('client/images/blog-photo1.jpg')}}"
                        alt="Media Object">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><a href="#">{{ $item->p_title }}</a></h4>
                    <span ><a href="#" style="color: cornflowerblue;">{{ $item->stu_name }}</a></span>
                </div>
            </div>
            @endforeach
        </div>
    </aside>
</div>
@endsection
@push('script')

@endpush
