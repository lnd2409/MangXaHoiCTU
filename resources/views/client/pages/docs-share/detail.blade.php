@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Quản lý tài liệu - Tên môn
@endsection

@section('content')
    {{-- {{ dd($folder) }} --}}
@if (Auth::guard('student')->id() == $folder->stu_id)
    <div class="row">
        <?php $url = asset('');?>
        <a href="{{ url($url."tai-khoan/tai-lieu?nienkhoa=$nkSelected&hocky=$hkSelected") }}" class="label label-default">Quay lại</a>
    </div>
@else
    <div class="row">
        <a href="{{ route('tai-lieu.sinhvien', ['codeStudent'=> $folder->stu_code]) }}" class="label label-default">Quay lại</a>
    </div>
@endif
<div class="row">
    <h2>Tài liệu môn học</h2>
    <h2 style="font-weight: bold;">{{ $folder->fo_name }}</h2>
    <p style="border-top: 2px solid blue;"></p>

    {{-- Up load --}}
    @if (Auth::guard('student')->id() == $folder->stu_id)
    <div class="col-md-12">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal1">
            Tải tệp lên
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
            Tạo thư mục
        </button>

    </div>
    @else
    @endif
</div>
<div class="row">
    {{-- Phần cây thư mục --}}
    {{-- Phần thư mục và file --}}
    @if (Auth::guard('student')->id() == $folder->stu_id)
    <div class="col-md-12"  style="padding-left: 0px;">
        @if ($folder->fo_child != null )
            <div class="col-md-12">
                <a href="{{ route('chi-tiet-thu-muc', [
                    'nkSelected' => $nkSelected1->school_year_id,
                    'hkSelected' => $hkSelected1->semester_id,
                    'nameFolder'=> $folder_child->fo_slug,
                    ]) }}" class="label label-warning">Quay lại</a>
            </div>
        @endif
        <div class="col-md-12">
            <h2>Thư mục</h2>
        </div>
        @if (count($folder_detail) > 0)
            @foreach ($folder_detail as $item)
                <div class="col-md-3">
                    <div class="folder">
                        <a href="{{ route('chi-tiet-thu-muc', [
                            'nkSelected' => $nkSelected1->school_year_id,
                            'hkSelected' => $hkSelected1->semester_id,
                            'nameFolder'=> $item->fo_slug,
                            ]) }}" class="btn
                                            @if ($item->fo_permission == 'access')
                                                btn-success
                                            @else
                                                btn-warning
                                            @endif" style="width: 100%;" id="right-click" data-id="{{ $item->fo_id }}">
                            <h5 style="font-size: 15px; text-align: center;">
                                <i class="fa fa-folder" aria-hidden="true"></i> {{$item->fo_name}}
                            </h5>
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-3">
                <div class="folder">
                    <h5>Không có thư mục con</h5>
                </div>
            </div>
        @endif
        <br>
        <br>

        <div class="col-md-12">
            <h2>Tập tin</h2>
        </div>
        @if (count($files) != null)
            @foreach ($files as $item)
                <div class="col-md-3">
                    <button href="#" style="width: 100%;height: 120px;line-height: 120px;background-color: #e2f8ff;color: black; white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis; " class="btn btn-success" style="width: 100%;" download>
                        <h5 style="font-size: 15px; padding-top: 5px;">
                            {{$item->f_name}}
                            <br>
                            <a href="{{ asset($item->f_path) }}" style="text-decoration: underline; font-size: 12px; color: blue;  ">Download</a>
                        </h5>
                    </button>
                </div>
            @endforeach
        @else
            <div class="col-md-3">
                <div class="folder">
                    <h5>Không có tệp</h5>
                </div>
            </div>
        @endif
    </div>
    @else
    <div class="col-md-12"  style="padding-left: 0px;">
        @if ($folder->fo_child != null )
            <div class="col-md-12">
                <a href="{{ route('chi-tiet-thu-muc-hoc-sinh', [
                    'nkSelected' => $nkSelected1->school_year_id,
                    'hkSelected' => $hkSelected1->semester_id,
                    'nameFolder'=> $folder_child->fo_slug,
                    'idStudent' => $folder->stu_id
                    ]) }}" class="label label-warning">Quay lại</a>
            </div>
        @endif
        <div class="col-md-12">
            <h2>Thư mục</h2>
        </div>
        @if (count($folder_detail) > 0)
            @foreach ($folder_detail as $item)
                @if ($item->fo_permission == 'access')
                    <div class="col-md-3">
                        <div class="folder">
                            <a href="{{ route('chi-tiet-thu-muc-hoc-sinh', [
                                'nkSelected' => $nkSelected1->school_year_id,
                                'hkSelected' => $hkSelected1->semester_id,
                                'nameFolder'=> $item->fo_slug,
                                'idStudent' => $folder->stu_id
                                ]) }}" class="btn
                                                @if ($item->fo_permission == 'access')
                                                    btn-success
                                                @else
                                                    btn-warning
                                                @endif" style="width: 100%;" id="right-click" data-id="{{ $item->fo_id }}">
                                <h5 style="font-size: 15px; text-align: center;">
                                    <i class="fa fa-folder" aria-hidden="true"></i> {{$item->fo_name}}
                                </h5>
                            </a>
                        </div>
                    </div>
                @else
                @endif
            @endforeach
        @else
            <div class="col-md-3">
                <div class="folder">
                    <h5>Không có thư mục con</h5>
                </div>
            </div>
        @endif
        <br>
        <br>

        <div class="col-md-12">
            <h2>Tập tin</h2>
        </div>
        @if (count($files) != null)
            @foreach ($files as $item)
                <div class="col-md-3">
                    <button href="#" style="width: 100%;height: 120px;line-height: 120px;background-color: #e2f8ff;color: black; white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis; " class="btn btn-success" style="width: 100%;" download>
                        <h5 style="font-size: 15px; padding-top: 5px;">
                            {{$item->f_name}}
                            <br>
                            <a href="{{ asset($item->f_path) }}" style="text-decoration: underline; font-size: 12px; color: blue;  ">Download</a>
                        </h5>
                    </button>
                </div>
            @endforeach
        @else
            <div class="col-md-3">
                <div class="folder">
                    <h5>Không có tệp</h5>
                </div>
            </div>
        @endif
    </div>
    @endif
</div>
<!-- Modal Upload file-->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tải tệp lên</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('upload-file') }}" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" value="{{ $folder->fo_id }}" hidden name="fo_id">
                    <input type="text" value="{{ $folder->fo_directory }}" hidden name="fo_dir">
                    <div class="file-loading">
                        <input id="input-res-1"
                        name="file[]"
                        type="file"
                        multiple
                        data-min-file-count="2"
                        >
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="uploadImage">Upload</button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>
    </div>
    </div>
</div>
<!-- Modal tạo thư mục-->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tạo thư mục</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('tao-thu-muc-con') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Đường dẫn hiện tại: {{ $folder->fo_directory }}</label>
                </div>
                <input name="mathumuchientai" type="hidden" value="{{$folder->fo_id}}">
                <input name="mamon" type="hidden" value="{{ $folder->sub_id }}">
                <input name="duongdan" type="hidden" value="{{$folder->fo_directory}}">
                <div class="form-group">
                    <label>Tên thư mục</label>
                    <input type="text" class="form-control" name="tenthumuc"  placeholder="Nhập tên thư mục cần tạo . . ">
                    <small id="emailHelp" class="form-text text-muted">Đặt tên thư mục liên quan đến môn học</small>
                </div>
                <button type="submit" class="btn btn-primary">Tạo</button>
            </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>
    </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // console.log("loi roi");
        $("#input-res-1").fileinput({
            uploadUrl: "{{ route('upload-file') }}",
            enableResumableUpload: true,
            initialPreviewAsData: true,
            maxFileNum: 5,
            theme: 'fas',
            uploadExtraData: function () {
                return {
                    _token: $("input[name='_token']").val()
                }
            },
            fileActionSettings: {
                showZoom: function(config) {
                    if (config.type === 'pdf' || config.type === 'image') {
                        return true;
                    }
                    return false;
                }
            }
        });

        $('.file-drop-zone-title').text('Kéo & thả file vào đây');
        $('.file-caption-name').attr('placeholder','Chọn file tải lên');
        $('.close fileinput-remove').attr('style','display: none;');
    });

</script>
@endsection
@if (Auth::guard('student')->id() == $folder->stu_id)
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
            },
            items: {
                // "edit": {name: "Thay đổi trạng thái", icon: "edit"},
                // "fold1": {
                //     "name": "Thay đổi trạng thái",
                //     "items": {
                //         "private": {"name": "Riêng tư"},
                //         "public": {"name": "Công khai"},
                //     }
                // },
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
@endif
