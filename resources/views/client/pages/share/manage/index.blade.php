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
        <!-- Blog Column -->
        <div class="col-md-12">
            <h4>Danh sách vật dụng</h4>
            <!-- Button trigger modal -->
            <a href="#" class="btn btn-primary col-md-2" data-toggle="modal" data-target="#exampleModal">
                Thêm loại vật dụng
            </a>
            <a href="{{ route('quan-tri.do-dung-chua-duyet') }}" class="btn btn-primary" style="margin-left: 10px;">
                Bài viết chưa duyệt ({{ $items }})
            </a>
            <a href="{{ route('quan-tri.danh-sach-chia-se') }}" class="btn btn-primary" style="margin-left: 10px;">
                Danh sách bài viết
            </a>
            <br><br>


            <table class="table table-bordered">
                <thead>

                    <tr>
                        <th>STT</th>
                        <th>Tên loại vật dụng</th>
                        <th>Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; ?>
                    @foreach ($typeItems as $item)
                        <tr >
                            <td style="line-height: 50px;">{{ $stt++ }}</td>
                            <td style="line-height: 50px;">{{ $item->type_name }}</td>
                            <td style="line-height: 50px;">
                                <a href="#" class="getIDtype" data-id="{{ $item->type_id }}" style="color: blue;" data-toggle="modal" data-target="#updateType">Sửa</a> &nbsp;&nbsp;&nbsp;
                                <a onclick="return DeleteItem()" href="{{ route('quan-tri.chia-se-do-dung.delete', ['id'=>$item->type_id]) }}" style="color: red;">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>





        </div>
    </div>
</div>
 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
             <h5 class="modal-title" id="exampleModalLabel">Tạo mới</h5>
         </div>
         <form enctype="multipart/form-data" action="{{ route('quan-tri.chia-se-do-dung.luu') }}" method="post" id="frmcrtclb">
             @csrf
             <div class="modal-body">
                 @csrf
                 <div class="form-group">
                     <input type="file" class="form-control" name="type_hinh" id="name"
                     placeholder="hình ảnh" required>
                 </div>
                 <div class="form-group">
                     <input type="text" class="form-control" name="type_name" id="name"
                     placeholder="Tên loại vật dụng" required>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                 <button type="submit" class="btn btn-primary">Tạo</button>
             </div>
         </form>
     </div>
 </div>
</div>
 <!-- Modal -->
 <div class="modal fade" id="updateType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
             <h5 class="modal-title" id="exampleModalLabel">Sửa Loại</h5>
         </div>
         <form enctype="multipart/form-data" action="{{ route('quan-tri.chia-se-do-dung.update') }}" method="post" id="frmcrtclb">
             @csrf
             <div class="modal-body">
                 @csrf
                 <div class="form-group">
                     <input type="file" class="form-control" name="type_hinh" id=""
                     placeholder="hình ảnh">
                 </div>
                 <div class="form-group">
                     <input type="text" class="form-control" name="type_name" id="type_name"
                     placeholder="Tên loại vật dụng" required>
                 </div>
                 <div class="form-group">
                     <input type="hidden" id="ididid" name="type_id"
                   >
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                 <button type="submit" class="btn btn-primary">Cập nhật</button>
             </div>
         </form>
     </div>
 </div>
</div>

@endsection
@push('script')
<script>

    function DeleteItem(){
        if(confirm("Bạn có muốn xóa ?"))
        {

            return true;
        }
        return false;
    }






   $('.getIDtype').click(function (e) {
       e.preventDefault();
       var id =$(this).attr("data-id");
       $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $.ajax({
        type: "post",
        url: " {{route('quan-tri.chia-se-do-dung.ajax')}} ",
        data: {id:id},
        dataType: "json",
        success: function (response) {
            console.log(response);
            $('#type_name').val(response.type_name);
            $('#ididid').val(response.type_id);
        }
    });

   });
</script>
@endpush
