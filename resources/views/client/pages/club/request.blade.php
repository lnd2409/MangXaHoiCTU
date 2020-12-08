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
    <div class="col-md-12 ">
        <div data-url="{{$club->c_slug}}" id="slug"></div>
        <div class="row">
            <h4>Danh sách yêu cầu tham gia <strong>{{$club->c_name}}</strong></h4>
            <h5>Admin:    <strong>{{auth::guard('student')->user()->stu_name}}</strong></h5>
            <div class="col-md-12">
                @if (count($list) != 0)
                <table class="table table-striped borderless">
                    <thead>
    
                        <tr>
                            <th>Tên sinh viên </th>
                            <th>Mã sinh viên</th>
                            <th>
                                <div>Ngày yêu cầu tham gia</div>
                            </th>
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
                                <td>
                                    <a href="#" data-data="{{$item->stu_code}}" data-url="{{$item->c_slug}}" data-no="{{$key}}"
                                        class="accept" style="color: #2f9de3" onclick="return DongY()">Duyệt</a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="#" data-data="{{$item->stu_code}}" data-url="{{$item->c_slug}}" data-no="{{$key}}"
                                        class="denied" style="color: red">Xóa</a>
                                </tr>
                                @endif
                            @endforeach
                            
                        </tbody>
                    </table>
                    
                </div>
                @else 
                <p><img src=" {{asset('svg/nulll.png')}} " alt="" style="width: 10%;position: relative;top: 10px;left: 514px;"></p>
                <p style="font-size: 25px;text-align: center;color: black;font-weight: bold;">  Không có yêu cầu nào !</p>
                @endif
        
         
        </div>






    </div>

    {{-- <div class="col-md-8"> --}}
        {{-- <div data-url="{{$club->c_slug}}" id="slug"></div> --}}
    {{-- <div class="row">

        @forelse ($list as $key=>$item)
        <div class="{{$key}}">
            <div class="col-md-2">
                <img src="{{asset($item->stu_avatar)}}" alt="" class="avatar">
            </div>
            <div class=" col-md-8 ">
                <h4 style="display: inline">
                    {{$item->stu_code}}
                </h4>
                <h4>

                    {{$item->stu_name}}<br>
                </h4>
                <p style="padding: 0;margin:0">

                    ngày: {{$item->cs_created}} <br>
                </p>
                <a href="#" data-data="{{$item->stu_code}}" data-url="{{$item->c_slug}}" data-no="{{$key}}"
                    class="accept" style="color: #2f9de3">Duyệt</a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" data-data="{{$item->stu_code}}" data-url="{{$item->c_slug}}" data-no="{{$key}}"
                    class="denied" style="color: red">Xóa</a>

            </div>

            <div class="col-md-12">&nbsp;</div>
        </div>
        @empty
        <h3>Không có yêu cầu nào</h3>
        @endforelse
    </div> --}}






</div>
<!-- Blog Sidebar Column -->
@include('client.pages.club.sidebar')




</div>

@endsection
@push('script')
<script>


    function DongY(){
        if(confirm('Bạn có muốn Duyệt người này ? '))
        {
            return true;
        }
        return false;
    }





    $(document).ready(function(){
        $(".accept").click(function(e){
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
                url: "{{route('club.accept',"+slug+")}}",
                data: {code:code,slug:slug},
                dataType: "json",
                success: function (response) {
                    $('.'+no).addClass('hidden');
                    if(response!='error'){
                        alert('Duyệt Thành công!');
                        window.location.href = "{{URL::to('cau-lac-bo/')}}"
                    }
                },
            });
        });
        $(".denied").click(function(e){
            e.preventDefault(); 
            var id=$(this).attr('data-data');
            var slug=$(this).attr('data-url');
            var no=$(this).attr('data-no');
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('club.denied',"+slug+")}}",
                data: {id:id,slug:slug},
                dataType: "json",
                success: function (response) {
                    $('.'+no).addClass('hidden');
                    if(response!='error'){
                        alert('Xóa Thành công!');
                        window.location.href = "{{URL::to('cau-lac-bo/')}}"
                    }
                },
            });
        });
    });
</script>
@endpush