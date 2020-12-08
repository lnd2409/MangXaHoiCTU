@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Thống kê - Chọn năm học và học kỳ
@endsection

@section('content')
<div class="row" style="margin-bottom: 20px;">
    <h1 class="text-center">Chọn năm học - học kỳ</h1>
    <p style="border-top: 2px solid blue;"></p>
    {{-- @foreach ($subject_student as $item)
        <div class="col-md-3">
            <div class="folder">
                <a href="#" class="btn btn-success" style="width: 100%;"><h5 style="font-size: 10px;"><i class="fa fa-folder" aria-hidden="true"></i> {{ $item->sub_name }}
    </h5></a>
</div>
</div>
@endforeach --}}
<form method="GET" action="{{ route('listLike') }}">
    <div class="form-group row">
        <div class="col-md-3"></div>
        <label class="col-md-1">Năm học</label>
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
        <div class="col-md-3"></div>
        <label class="col-md-1">Học kỳ</label>
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



{{-- <script>
    $(document).ready(function() {
        $("#input-res-1").fileinput({
            uploadUrl: "/site/test-upload",
            enableResumableUpload: true,
            initialPreviewAsData: true,
            maxFileCount: 5,
            theme: 'fas',
            deleteUrl: '/site/file-delete',
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
        $('.close fileinput-remove').style('display','none');
    });
    </script> --}}
@endsection
@push('script')
@endpush