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
        <h4>Danh sách bài viết</h4>
        <!-- Blog Column -->
        <div class="">
            <!-- Button trigger modal -->
            <a href="{{ route('quan-tri.chia-se-do-dung') }}" class="btn btn-primary">
                Quay lại
            </a>
            <div class="" style="float: right">
                <form action="{{ route('item.admin.find') }}" method="post" id="SendForm">
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
                        <th>Ngày đăng</th>
                        <th>Loại vật dụng</th>
                        <th>Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; ?>
                    @foreach ($share as $item)
                        <tr >
                            <td style="line-height: 50px;">{{ $stt++ }}</td>
                            <td style="line-height: 50px;">{{ $item->item_title }}</td>
                            <td style="line-height: 50px;">{{ $item->item_name }}</td>
                            <td style="line-height: 50px;">{{ Carbon\Carbon::parse($item->item_created)->format('d-m-Y') }}</td>
                            <td style="line-height: 50px;">{{ $item->type_name }}</td>
                            <td style="line-height: 50px;">
                                <a href="{{ route('quan-tri.duyet-chia-se', ['action'=>'detail','idItem'=>$item->item_id]) }}" style="color: blue;">Chi tiết</a> &nbsp;&nbsp;&nbsp;
                                <a href="{{ route('quan-tri.duyet-chia-se', ['action'=>'delete','idItem'=>$item->item_id]) }}" style="color: red;">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="col-md-12" style="text-align: center">
                {{$share->links()}}
            </div>



        </div>
    </div>
</div>
@endsection
