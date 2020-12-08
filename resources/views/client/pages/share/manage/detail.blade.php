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
@section('content')

<!-- Page Content -->
<div class="row">

    <div class="col-md-1"></div>
    <article class="col-md-10 o-giua">
        {{-- <hr> --}}
        <a href="{{ route('quan-tri.danh-sach-chia-se') }}  " class="btn btn-primary">
            Quay lại
        </a>
        <div class="row">
            <div class="col-md-12">
                <h1 class="sidebar-title" style="width:100%;margin 20px;text-transform: uppercase;">{{$post->item_title}}</h1>
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
    </article>
    <div class="col-md-1"></div>
    <div class="col-md-1 clear-center"></div>
    <div id="myModal" class="modal" aria-hidden="true" tabindex="-1" role="dialog">


        <img class="modal-content" id="img01">


    </div>
</div>

@endsection
