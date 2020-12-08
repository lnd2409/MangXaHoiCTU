@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
{{$student->stu_name}}
@endsection
@push('css')
<style>
    .level_1 {
        text-align: right
    }

    .level_2 {
        text-align: left
    }

    thead {
        background-color: #3571ad;
        color: white;
    }

    hr {
        border-color: #3571ad;
    }

    thead th:first-child {
        border-radius: 10px 0px 0px 0px;
    }

    thead th:last-child {
        border-radius: 0px 10px 0px 0px;
    }

    .fade {
        display: inline !important;
    }
</style>
@endpush
@section('content')
@if (Auth::guard('student')->user()->stu_code == $student->stu_code)
<div class="col-12">
</div>
@else
    <h4>Thông tin</h4>
    <a href="{{ route('tai-lieu.sinhvien', ['codeStudent' => $student->stu_code]) }}" class="btn btn-success">Tài liệu công khai</a>
@endif
<div class="col-12">
    @if (Auth::guard('student')->user()->stu_code == $student->stu_code)
        <h3 class="text-center">Thông tin cá nhân</h3>
    @else
        <h3 class="text-center">Thông tin sinh viên</h3>
    @endif
</div>

<table class="table table-striped borderless">
    <tr>
        <td width="21%" class="level_1 font-weight-bold ">Mã số sinh viên </td>
        <td width="24%" class="level_2" id="stu_code">
            {{$student->stu_code}}
        </td>
        <td width="23%" class="level_1">Họ và tên </td>
        <td class="level_2">
            {{$student->stu_name}}
        </td>
    </tr>
    <tr>
        <td class="level_1 ">Ngày sinh </td>
        <td class="level_2">
            {{$student->stu_birth}}
        </td>
        <td class="level_1">Chuyên ngành</td>
        <td class="level_2">
            {{$student->major_name}}
        </td>
    </tr>
    <tr>
        <td class="level_1">Lớp</td>
        <td class="level_2">{{$student->yb_name}}&nbsp;</td>
        <td class="level_1">Khoa</td>
        <td class="level_2">{{$student->academy_name}}&nbsp;</td>
    </tr>
    <tr>
        <td class="level_1">Thuộc chi hội</td>
        <td class="level_2">
            {{$student->ub_name}}&nbsp;</td>
        <td class="level_1">Ngày tham gia</td>
        <td class="level_2">{{$student->sub_created}}&nbsp; </td>
    </tr>
    <tr>
        <td class="level_1">Đã thích</td>
        <td class="level_2" id="luotLike">{{$Data['Like']}}&nbsp;
        </td>
        <td class="level_1">Đã báo cáo</td>
        <td class="level_2">{{$Data['Report']}}&nbsp; </td>
    </tr>
    <tr>
        <td class="level_1">Bài viết đã đăng</td>
        <td class="level_2" id="baiDaDang">{{$Data['Post']}} &nbsp;</td>
        <td class="level_1">Lượt bình luận</td>
        <td class="level_2">{{$Data['Comment']}}&nbsp;</td>
    </tr>
    <tr>
        <td class="level_1">Lượt thích nhận được</td>
        <td class="level_2" id="daLike">{{$Data['Liked']}} &nbsp;</td>
        <td class="level_1">Bị báo cáo</td>
        <td class="level_2">{{$Data['Reported']}}&nbsp; </td>
    </tr>
</table>
<hr>
<h4>Câu lạc bộ đã tham gia</h4>
<table class="table table-striped borderless">
    <thead>

        <tr>
            <th>STT</th>
            <th>Tên câu lạc bộ</th>
            <th>Ngày tham gia</th>

            {{-- <th>
                <div data-toggle="tooltip" title="Bài viết bạn đã xem kể từ khi tham gia">Bài viết đã xem</div>
            </th>
            <th data-toggle="tooltip" title="Tổng bài viết từ khi tham gia">Tổng bài viết
            </th>
            <th data-toggle="tooltip" title="Tỉ lệ bài đã xem trên tổng bài của clb kể từ khi bạn tham gia">Tỉ lệ đóng
                góp (%)</th> --}}
            <th>
                <div>Bài viết đã xem</div>
            </th>
            <th>Tổng bài viết
            </th>
            <th>Tỉ lệ đóng
                góp (%)</th>
        </tr>
    </thead>
    <tbody id="club">
        <?php $i=1?>
        @foreach ($JoinedClub as $item)
        <tr>
            <td>{{$i}}</td>
            <td>{{$item->c_name}}</td>
            <td>{{$item->cs_created}}</td>
            <td>{{$item->view}}</td>
            <td>{{$item->posTotal}}</td>
            <td>{{$item->perContribute}}</td>
        </tr>
        <?php $i++?>
        @endforeach
    </tbody>
</table>
<hr>
<h4>Vật dụng đã chia sẻ</h4>
<table class="table table-striped borderless">
    <thead>

        <tr>
            <th>STT</th>
            <th>Loại vật dụng</th>
            <th>Tên vật dụng</th>
            <th>Ngày trao tặng</th>
            <th>Lượt cảm ơn</th>
            <th>Lượt không thích</th>
            <th>Lượt xem</th>
        </tr>
    </thead>
    <tbody id="shareitem">
        <?php $i=1?>
        @foreach ($ShareItem as $item)
        <tr>
            <td>{{$i}}</td>
            <td>{{$item->type_name}}</td>
            <td>{{$item->item_name}}</td>
            <td>{{$item->item_created}}</td>
            <td>{{$item->thanks}}</td>
            <td>{{$item->dislike}}</td>
            <td>{{$item->view}}</td>
        </tr>
        <?php $i++?>
        @endforeach
    </tbody>
</table>
<hr>
<h4>Câu hỏi đã trao đổi trên diễn đàn</h4>
<table class="table table-striped borderless">
    <thead>

        <tr>
            <th>STT</th>
            <th>Năm học học kỳ</th>
            <th>Mã học phần</th>
            <th>Tên học phần</th>
            <th>Số câu hỏi</th>
            <th>Lượt phúc đáp</th>
            <th>Lượt xem</th>
        </tr>
    </thead>
    <tbody id="postforum">
        <?php $i=1?>
        @foreach ($PostForum as $item)
        <tr>
            <td>{{$i}}</td>
            <td>{{$item->school_year_name}} {{$item->semester_name}}</td>
            <td>{{$item->sub_code}}</td>
            <td>{{$item->sub_name}}</td>
            <td>{{$item->post}}</td>
            <td>{{$item->comment}}</td>
            <td>{{$item->view}}</td>
        </tr>
        <?php $i++?>
        @endforeach
    </tbody>

</table>

@endsection
@push('script')
<script>
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
{{-- @include('client.pages.account.script') --}}
@endpush
