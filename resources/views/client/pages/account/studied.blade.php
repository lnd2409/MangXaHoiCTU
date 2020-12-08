@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
{{-- {{$student->stu_name}} --}}
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
<table class="table table-striped borderless">
    <thead>

        <tr>
            <th>STT</th>
            <th>Mã môn</th>
            <th>Tên môn</th>
            <th>Năm học</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt=1?>
        @forelse ($data as $item)
        <tr>
            <td>{{$stt}}</td>
            <td>{{$item->sub_code}}</td>
            <td>{{$item->sub_name}}</td>
            <td>{{$item->school_year_name}} {{$item->semester_name}}</td>
        </tr>
        <?php $stt++?>
        @empty

        @endforelse
    </tbody>
</table>
@endsection
@push('script')
<script>
</script>
{{-- @include('client.pages.account.script') --}}
@endpush