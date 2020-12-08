@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Tài liệu cá nhân
@endsection

@section('content')
    <div class="row">
        <h3>Từ khóa: <i>{{ $tenMonHoc }}</i></h3>
    </div>
<div class="row" style="margin-bottom: 20px;" id="right-click-bg">
    <h1>Kết quả</h1>
    <p style="border-top: 2px solid blue;"></p>
    @foreach ($result as $item)
        <div class="col-md-12">
            <div class="col-md-4">
                <div class="folder">
                    <a href="#" style="color: black;"><b>Tác giả:</b> {{ $item->stu_name }}</a>
                    <br>
                    <a href="#" style="color: black;"><b>Tên môn học:</b> {{ $item->sub_name }}</a>
                    <a style="color: black; font-weight: bold;">{{ $item->semester_name }} - {{ $item->school_year_name }}</a>
                    <a href="
                        {{ route('chi-tiet-thu-muc-hoc-sinh', [
                            'nienkhoa' => $item->school_year_id,
                            'hocky' => $item->semester_id,
                            'nameFolder'=> $item->fo_slug,
                            'idStudent' => $item->stu_id
                        ]) }}

                        "
                        class="btn
                        @if ($item->fo_permission == 'access')
                            btn-success
                        @else
                            btn-warning
                        @endif"
                        style="width: 100%;" id="right-click" data-id="{{ $item->fo_id }}">
                        <h5 style="font-size: 15px; text-align: center;">
                        <i class="fa fa-folder" aria-hidden="true"></i> : {{ $item->fo_name }}
                        </h5>
                    </a>
                    {{-- @if ($item->stu_id == Auth::guard('student')->id())
                        <a href="{{ route('chi-tiet-thu-muc', [

                            'nienkhoa' => $nkSelected->school_year_id,
                            'hocky' => $hkSelected->semester_id,
                            'nameFolder'=> $item->fo_slug,
                            ]) }}"
                            class="btn
                            @if ($item->fo_permission == 'access')
                                btn-success
                            @else
                                btn-warning
                            @endif"
                            style="width: 100%;" id="right-click" data-id="{{ $item->fo_id }}">
                            <h5 style="font-size: 15px; text-align: center;">
                            <i class="fa fa-folder" aria-hidden="true"></i> : {{ $item->fo_name }}
                            </h5>
                        </a>
                    @else
                        <a href="{{ route('chi-tiet-thu-muc-hoc-sinh', [

                                                            'nienkhoa' => $nkSelected->school_year_id,
                                                            'hocky' => $hkSelected->semester_id,
                                                            'nameFolder'=> $item->fo_slug,
                                                            'idStudent' => $sub_studied[0]->stu_id
                                                            ]) }}"
                                                            class="btn
                                                            @if ($item->fo_permission == 'access')
                                                                btn-success
                                                            @else
                                                                btn-warning
                                                            @endif"
                                                            style="width: 100%;" id="right-click" data-id="{{ $item->fo_id }}">
                            <h5 style="font-size: 20px;">
                                <i class="fa fa-folder" aria-hidden="true"></i> {{ $item->fo_name }}
                            </h5>
                        </a>
                    @endif --}}
                </div>
                <br>
            </div>
        </div>
    @endforeach
</div>


@endsection
