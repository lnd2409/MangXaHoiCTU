@extends('client.client')
@push('css')
<style>
    .avatar {
        width: 100%;
    }
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
{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Yêu cầu tham gia
@endsection

@section('content')

<div class="row">
    {{-- <div class="col-md-3">

        </div> --}}
    <!-- Blog Column -->


    <div class="col-md-12 ">
        <div data-url="{{$club->c_slug}}" id="slug"><span> <a style="float: right" href="{{ route('club.listRequest', ['id'=>$club->c_slug]) }}" class="btn btn-ctu">Danh sách yêu cầu</a> </span></div>
        
        <div class="row">
            <h4>Câu lạc bộ <strong>{{$club->c_name}}</strong></h4>
            <div class="col-md-12">
                <table class="table table-striped borderless">
                    <thead>
    
                        <tr>
                            <th>Tên sinh viên </th>
                            <th>Mã sinh viên</th>
                            <th>
                                <div>Ngày tham gia</div>
                            </th>
                            <th>Số bài đăng
                            </th>
                            <th>Chức vụ</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="club">
                       
                        @foreach($list as $key=>$item)
                        @if ($item->stu_code == auth::guard('student')->user()->stu_code)

                        @else
                        
                        <tr>
                           <td>{{$item->stu_name}}</td>
                           <td>{{$item->stu_code}}</td>
                           <td>{{$item->cs_created}}</td>
                           <td>{{$item->count}}</td>
                               <td>
                                <select name="role" id="" class="role" data-no="{{$item->stu_code}}">
                                    {{-- <option value="CNCLB" @if($item->cs_role=='CNCLB') selected @endif>CNCLB</option> --}}
                                    <option value="PCNCLB" @if($item->cs_role=='PCNCLB') selected @endif>PCNCLB</option>
                                    <option value="UVCLB" @if($item->cs_role=='UVCLB') selected @endif>UVCLB</option>
                                    <option value="TV" @if($item->cs_role=='TV') selected @endif>TV</option>
                                </select>
                               </td>
                           <td>
                            <a href="#" data-data="{{$item->stu_code}}" data-url="{{$club->c_slug}}" data-no="{{$key}}"
                                class="delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                           </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                {{$list->links()}}
            </div>
        
            {{-- @forelse ($list as $key=>$item)
            <div class="col-md-2">
                <img src="{{asset($item->stu_avatar)}}" alt="" class="avatar">
            </div>
            <div class="{{$key}} col-md-8 ">
                <h4 style="display: inline">

                    {{$item->stu_code}}
                </h4>
                <span style="float: right">
                    <a href="#" data-data="{{$item->stu_code}}" data-url="{{$club->c_slug}}" data-no="{{$key}}"
                        class="delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                </span><br>
                <h4>

                    {{$item->stu_name}}<br>
                </h4>
                <p style="padding: 0;margin:0">

                    ngày tham gia: {{$item->cs_created}} <br>
                    số bài đăng: {{$item->count}} <br>
                </p>
                <select name="role" id="" class="role" data-no="{{$item->stu_code}}">
                    <option value="CNCLB" @if($item->cs_role=='CNCLB') selected @endif>CNCLB</option>
                    <option value="PCNCLB" @if($item->cs_role=='PCNCLB') selected @endif>PCNCLB</option>
                    <option value="UVCLB" @if($item->cs_role=='UVCLB') selected @endif>UVCLB</option>
                    <option value="TV" @if($item->cs_role=='TV') selected @endif>TV</option>
                </select>

            </div>

            <div class="col-md-12">&nbsp;</div>
            @empty
            <h3>Không có yêu cầu nào</h3>
            @endforelse --}}
        </div>






    </div>
    <!-- Blog Sidebar Column -->
    @include('client.pages.club.sidebar')
</div>

@endsection
@push('script')
<script>
    $(document).ready(function(){
        var selected = $(".role option:selected");
        $(".role").change(function(e){
            if(!confirm("bạn có chắc chắn")){
                selected.prop("selected", true);
                return false;
            }
            selected = $(this).find("option:selected");
            //mssv
            var code=$(this).attr('data-no');
            //vai trò
            var value=$(this).val();
            //slug
            var slug=$("#slug").attr('data-url');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('club.changeRole',"+slug+")}}",
                data: {code:code,value:value,slug:slug},
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if(response=='error'){
                        alert('có lỗi xảy ra, vui lòng thử lại');
                    }
                },
            });
        });
        $(".delete").click(function(e){
            if(!confirm("Bạn có chắc muốn xóa")){
                return false;
            }
            e.preventDefault(); 
            var code=$(this).attr('data-data');
            var slug=$(this).attr('data-url');
            var no=$(this).attr('data-no');
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('club.delete',"+slug+")}}",
                data: {code:code,slug:slug},
                dataType: "json",
                success: function (response) {
                    $('.'+no).addClass('hidden');
                    if(response=='error'){
                        alert('có lỗi xảy ra, vui lòng thử lại');
                    }
                },
            });
        });
    });

</script>
@endpush