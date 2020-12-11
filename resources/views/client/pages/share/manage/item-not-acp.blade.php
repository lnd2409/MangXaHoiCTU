@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Danh sách loại vật dụng
@endsection
@push('css')
<link rel="stylesheet" href="{{asset('/vendor/font-awesome/css/font-awesome.min.css')}}">
<style>
    thead {
        background-color: #3571ad;
        color: white;
    }

    thead th:first-child {
        border-radius: 10px 0px 0px 0px;
    }

    thead th:last-child {
        border-radius: 0px 10px 0px 0px;
    }

    .btn-primary {
        background-color: #28a745;
    }

    .btn-primary:hover {
        background-color: #3571ad;
    }

    .edi {
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom-style: hidden;
        background-color: transparent;
        width: 100%;
    }

    .edi:hover {
        background-color: #11589f;
        color: white;
    }
</style>
@endpush

@section('content')

<div class="container">
    <div class="row">
        <h4>Danh sách bài viết chưa duyệt</h4>
        <!-- Blog Column -->
        <div class="">
            <!-- Button trigger modal -->
            <a href="{{ route('quan-tri.chia-se-do-dung') }}" class="btn btn-primary">
                Quay lại
            </a>
            <div class="" style="float: right">
                <form action="{{ route('item.post.admin.find') }}" method="post" id="SendForm">
                    @csrf
                    <input type="text" class="form-control" id="Search" name="post_content" placeholder="Tìm kiếm từ khóa">
                </form>
            </div>
            <br><br>


            <table class="table table-bordered">
                <thead>

                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Người đăng</th>
                        <th>
                            <?php
                                if ($sort == 0) {
                                    # code...
                                    $route = route('quan-tri.do-dung-chua-duyet', ['sort'=> 1]);
                                }
                                else if($sort == 1) {
                                    # code...
                                    $route = route('quan-tri.do-dung-chua-duyet', ['sort'=> 2]);
                                }
                                else {
                                    # code...
                                    $route = route('quan-tri.do-dung-chua-duyet', ['sort'=> 0]);
                                }

                            ?>
                            <a href="{{ $route }}" style="color: white;">
                                Ngày đăng <i class="fa fa-sort" aria-hidden ></i>
                            </a>
                        </th>
                        <th>Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; ?>
                    @if (!empty($items))
                        @foreach ($items as $item)
                        <tr >
                            <td style="line-height: 50px;">{{ $stt++ }}</td>
                            <td style="line-height: 50px;">{{ $item->item_title }}</td>
                            <td style="line-height: 50px;">{{ $item->item_name }}</td>
                            <td style="line-height: 50px;">{{ Carbon\Carbon::parse($item->item_created)->format('d-m-Y') }}</td>
                            <td style="line-height: 50px;">
                                <a href="{{ route('quan-tri.duyet-chia-se', ['action'=>'accept','idItem'=>$item->item_id]) }}" style="color: blue;">Duyệt</a> &nbsp;&nbsp;&nbsp;
                                <a href="{{ route('quan-tri.duyet-chia-se', ['action'=>'detail','idItem'=>$item->item_id]) }}" style="color: green;">Chi tiết</a> &nbsp;&nbsp;&nbsp;
                                <a href="{{ route('quan-tri.duyet-chia-se', ['action'=>'delete','idItem'=>$item->item_id]) }}" style="color: red;">Xóa</a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="5" style="text-align: center; font-size:16px">Không có bài viết nào</td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>
        <div class="col-md-12" style="text-align: center">
            {{$items->links()}}
        </div>
    </div>
</div>

@endsection
