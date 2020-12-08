@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Đặt câu hỏi
@endsection

@section('content')
<!-- Page Content -->
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 o-giua">
        <h3 class="sidebar-title">Thêm câu hỏi học tập</h3>
        <form action="" method="post">
            @csrf
            <table class="table table-responsive borderless text-right">
                <tr>
                    <td style="white-space: nowrap;">Môn học
                    </td>
                    <td>
                        <select name="subject" id="" class="form-control" style="color: #555;">
                            @foreach ($subject as $item)

                            <option value="{{$item->sub_id}}">{{$item->sub_name}}</option>
                            @endforeach
                        </select>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td style="white-space: nowrap;">Tiêu đề <red-star></red-star>
                    </td>
                    <td><input type="text" class="form-control" name="title">
                        <br></td>
                </tr>
                <br>
                <tr>
                    <td style="white-space: nowrap;">Nội dung <red-star></red-star>
                    </td>
                    <td>
                        <textarea name="content" id="" class="tiny " cols="30" rows="20"></textarea>

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: left">
                        <button type="submit" class="btn btn-ctu">Gửi bài lên diễn đàn</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="col-md-1 clear-center"></div>
    <!-- Blog Sidebar Column -->
</div>

@endsection
@push('script')
<script>

</script>
@endpush
