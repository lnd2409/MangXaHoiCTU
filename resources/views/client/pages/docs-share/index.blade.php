@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Quản lý tài liệu
@endsection

@section('content')
{{-- {{ dd(count($sub_studied)) }} --}}
@if(count($sub_studied) != 0)
    @if ($sub_studied[0]->stu_id != Auth::guard('student')->id())
    <div class="row">
        <h1>Tài liệu: {{ $sub_studied[0]->stu_id }}</h1>
        <p style="border-top: 2px solid blue;"></p>
    </div>
    @endif
@else
    <div class="row">
        <h1>Quản lý tài liệu cá nhân</h1>
        <p style="border-top: 2px solid blue;"></p>
    </div>
@endif

@if(count($sub_studied) != 0)
    @if ($sub_studied[0]->stu_id != Auth::guard('student')->id())
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 20px;">
                <h3>Chọn năm học - học kỳ</h3>
                <form method="GET" action="{{ route('tai-lieu') }}">
                    <div class="form-group row">
                        <label class="col-md-2">Năm học</label>
                        <div class="col-md-4">
                            <select class="form-control" id="exampleFormControlSelect1" name="nienkhoa">
                                @foreach ($nienkhoa as $item)
                                    <option value="{{ $item->school_year_id }}">{{ $item->school_year_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">Học kỳ</label>
                        <div class="col-md-4">
                            <select class="form-control" id="exampleFormControlSelect1" name="hocky">
                                @foreach ($hocky as $item)
                                    <option value="{{ $item->semester_id }}">{{ $item->semester_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4"><button type="submit" class="btn btn-success">Chọn</button></div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-6" style="margin-bottom: 20px;">
                <h3>Chọn năm học - học kỳ</h3>
                <form method="GET" action="{{ route('tai-lieu') }}">
                    <div class="form-group row">
                        <label class="col-md-2">Năm học</label>
                        <div class="col-md-4">
                            <select class="form-control" id="exampleFormControlSelect1" name="nienkhoa">
                                @foreach ($nienkhoa as $item)
                                    <option value="{{ $item->school_year_id }}">{{ $item->school_year_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">Học kỳ</label>
                        <div class="col-md-4">
                            <select class="form-control" id="exampleFormControlSelect1" name="hocky">
                                @foreach ($hocky as $item)
                                    <option value="{{ $item->semester_id }}">{{ $item->semester_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4"><button type="submit" class="btn btn-success">Chọn</button></div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h3>Các môn học trong:
                    {{ $hkSelected->semester_name }} - {{ $nkSelected->school_year_name }}
                </h3>
                <div class="list-group" style="color: black; font-weight: bold">
                    @if (count($subject_student) == 0)
                        <p class="text-center" style="color: red;">Đã tạo hết thư mục</p>
                    @endif
                    @foreach ($subject_student as $item1)
                            <p href="" class="list-group-item list-group-item-action">
                                {{ $item1->sub_name }}
                                <a href="{{ route('tao-thu-muc-mon-hoc', ['id_mon_hoc'=> $item1->sub_id, 'ten_mon_hoc' => $item1->sub_name]) }}" style="float: right">
                                    TẠO <i class="fa fa-plus-square" aria-hidden="true" ></i>
                                </a>
                            </p>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@else
    <div class="row">
        <div class="col-md-6" style="margin-bottom: 20px;">
            <h3>Chọn năm học - học kỳ</h3>
            <form method="GET" action="{{ route('tai-lieu') }}">
                <div class="form-group row">
                    <label class="col-md-2">Năm học</label>
                    <div class="col-md-4">
                        <select class="form-control" id="exampleFormControlSelect1" name="nienkhoa">
                            @foreach ($nienkhoa as $item)
                                <option value="{{ $item->school_year_id }}">{{ $item->school_year_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">Học kỳ</label>
                    <div class="col-md-4">
                        <select class="form-control" id="exampleFormControlSelect1" name="hocky">
                            @foreach ($hocky as $item)
                                <option value="{{ $item->semester_id }}">{{ $item->semester_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4"><button type="submit" class="btn btn-success">Chọn</button></div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <h3>Các môn học trong:
                {{ $hkSelected->semester_name }} - {{ $nkSelected->school_year_name }}
            </h3>
            <div class="list-group" style="color: black; font-weight: bold">
                @if (count($subject_student) == 0)
                    <p class="text-center" style="color: red;">Đã tạo hết thư mục</p>
                @endif
                @foreach ($subject_student as $item1)
                        <p href="" class="list-group-item list-group-item-action">
                            {{ $item1->sub_name }}
                            <a href="{{ route('tao-thu-muc-mon-hoc', ['id_mon_hoc'=> $item1->sub_id, 'ten_mon_hoc' => $item1->sub_name]) }}" style="float: right">
                                TẠO <i class="fa fa-plus-square" aria-hidden="true" ></i>
                            </a>
                        </p>
                @endforeach
            </div>
        </div>
    </div>
@endif


<div class="row" style="margin-bottom: 20px;" id="right-click-bg">
    <h1>Thư mục môn học</h1>
    <p style="border-top: 2px solid blue;"></p>
    @foreach ($sub_studied as $item)
        <div class="col-md-4">
            <div class="folder">
                @if ($item->stu_id == Auth::guard('student')->id())
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
                @endif
            </div>
        </div>
    @endforeach
</div>


@endsection
@push('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js"></script>
<script>
    $(document).ready(function () {
        $.contextMenu({
            selector: '#right-click',
            callback: function(key, options) {
                var id = $(this).data('id');
                if (key == "change") {
                    console.log(id);
                    var url = '{{ URL::to('tai-khoan/tai-lieu/thu-muc/thay-doi-trang-thai/') }}/' + id;
                    console.log(url);
                    $.ajax({
                        type: "GET",
                        url: url,
                        // data: "data",
                        dataType: "json",
                        success: function (response) {
                            alert(response);
                            location.reload();
                        }
                    });
                }

                if(key == "delete") {
                    console.log(id);
                    var url = '{{ URL::to('tai-khoan/tai-lieu/thu-muc/xoa-thu-muc/') }}/' + id;
                    console.log(url);
                    const del = confirm("Bạn có muốn xóa thư mục này ?");
                    if(del == true){
                        $.ajax({
                            type: "GET",
                            url: url,
                            // data: "data",
                            dataType: "json",
                            success: function (response) {
                                alert(response);
                                location.reload();
                            }
                        });
                    }
                    else{

                    }

                }
            },
            items: {
                "change" : {name : "Thay đôi trạng thái"},
                "delete": {name: "Xóa"},
            }
        });

        $.contextMenu({
            selector: '#right-click-bg',
            callback: function(key, options) {
                // var m = "clicked: " + key;
                // window.console && console.log(m) || alert(m);
                if(key == "delete"){
                    alert("Đã xóa");
                }else if(key == "private"){
                    alert("Đã chuyển trạng thái về riêng tư")
                }else if(key == "public"){
                    alert("Đã chuyển trạng thái về công khai")
                }
            },
            items: {
                "paste": {name: "Dán"},
                "cancel": {name: "Hủy"},
            }
        });
    });
</script>
@endpush
