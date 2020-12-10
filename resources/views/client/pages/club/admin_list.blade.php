@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Danh sách câu lạc bộ
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
        <h4>Danh sách câu lạc bộ</h4>
      
        <!-- Blog Column -->
        <div class="">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Thêm câu lạc bộ
            </button>
            
            <div class="" style="float: right">
                <form action="{{ route('club.admin.find') }}" method="post" id="SendForm">
                    @csrf
                    <input type="text" class="form-control" id="Search" name="S_content" placeholder="Tìm kiếm từ khóa">
                </form>
            </div>
            <br><br>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="exampleModalLabel">Tạo câu lạc bộ</h5>
                        </div>
                        <form action="" method="post" id="frmcrtclb">
                            <div class="modal-body">
                                @csrf
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Tên câu lạc bộ">
                                <br>
                                <input type="text" class="form-control" name="name" id="CNCLB"
                                    placeholder="MSSV chủ nhiệm clb">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary">Tạo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table table-striped borderless">
                <thead>

                    <tr>
                        <th>STT</th>
                        <th>Câu lạc bộ</th>
                        <th>Chủ nhiệm</th>
                        <th>Phó chủ nhiệm</th>
                        <th>Tác vụ</th>
                    </tr>
                </thead>
                <tbody id="club">
                    <?php $i=1?>
                    @foreach ($list as $item)
                    <tr>
                        <td>{{$i}}</td>
                        <td><input type="text" class="edi" data-id="{{$item->c_id}}" value="{{$item->c_name}}"></td>
                        <td><span style="font-weight: bold">{{ $item->stu_name }}</span> - {{ $item->stu_code }}</td>
                        <td>
                            {{-- <span style="font-weight: bold">$value->stu_name</span> --}}
                            <?php
                                $PCN = DB::table('club_students')
                                        ->join('clubs','clubs.c_id','club_students.c_id')
                                        ->join('students','students.stu_id','club_students.stu_id')
                                        ->where('club_students.c_id',$item->c_id)
                                        ->where('cs_role','PCNCLB')
                                        ->get();
                                foreach ($PCN as $key => $value) {
                                    # code...
                                    echo '<span style="font-weight: bold">'.$value->stu_name.'</span>'.' - '.$value->stu_code.'<br>';
                                }
                            ?>
                        </td>
                        <td>
                            <form action="{{route('club.admin.adminDelete',$item->c_id)}}" method="post" id="frmrmcl"
                                onsubmit="return confirm('Bạn có chắc muốn câu lạc bộ này?');">
                                @csrf
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="submit" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn"
                                    style="background-color: transparent;"><i class=" fa fa-times" aria-hidden="true"
                                        style="color: red"></i> </button>
                            </form>
                        </td>

                    </tr>
                    <?php $i++?>
                    @endforeach
                </tbody>
            </table>

            <div class="col-md-12" style="text-align: center">
                {{$list->links()}}
            </div>


        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    $(document).ready(function(){


        $('#Search').mouseenter(function () { 
            $('SendForm').submit();
        });





        $("#CNCLB").keypress(function(e){

        });
        $("#frmcrtclb").submit(function(e){

            e.preventDefault();
            var name=$('#name').val();
            var CNCLB=$('#CNCLB').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('club.admin.create')}}",
                data: {name:name,CNCLB:CNCLB},
                dataType: "json",
                success: function (response) {
                    location.reload();
                    $(".close").click();
                },
                error: function (response) {
                    alert(response.responseJSON);
                },

            });
        });
        $('.edi').bind("enterKey",function(e){
            e.preventDefault();
            var id=$(this).attr('data-id');
            var name=$(this).val();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-Token':'{{csrf_token()}}',
                }
            });
            $.ajax({
                type: "post",
                url: "{{route('club.admin.adminUpdate')}}",
                data: {id:id,name:name},
                dataType: "json",
                success: function (response) {
                },
                error: function (response) {
                }
            });
        });
        $(".edi").focus(function() {
        }).blur(function() {
            $(this).trigger("enterKey");
        });
        $('.edi').keyup(function(e){
            if(e.keyCode == 13||e.keyCode==9)
            {
                $(this).trigger("enterKey");
            }
        });

    });
</script>
@endpush
