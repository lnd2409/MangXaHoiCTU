@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Danh sách câu lạc bộ
@endsection
@push('css')
<link rel="stylesheet" href="{{asset('/vendor/font-awesome/css/font-awesome.min.css')}}">
@endpush

@section('content')

<div class="row">
    <!-- Blog Column -->
    <div class="col-md-8">

        @foreach ($list as $item)
        <ul>
            <li>
                <h2 style="display: inline;color:#E96840" class="blog-title">

                    {{$item->c_name}}
                </h2>
                @if($item->status==0)
                <span style="float: right">

                    <a href="{{route('club.join',$item->c_slug)}}"><i class="fa fa-user-plus"
                            aria-hidden="true"></i></a>
                </span>
                @endif
                <p style="padding: 0;margin:0">
                    {{$item->sothanhvien}} thành viên <br>
                    {{$item->sobaiviet}} bài viết <br>
                </p>
                <hr>

            </li>
        </ul>
        @endforeach




    </div>
    @include('client.pages.club.sidebar')
</div>

@endsection
@push('script')
@endpush
