@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Danh sách thành viên
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
        <h4>Danh sách <strong>{{$chihoi->ub_name}} </strong></h4>
        <!-- Blog Column -->
        <div class="">
            <!-- Button trigger modal -->
            <a href="{{ route('union') }}" class="btn btn-ctu" >
                Trở về
            </a>
        <br><br>
           
            <table class="table table-bordered">
                <thead>

                    <tr>
                        <th>STT</th>
                        <th>Tên sinh viên</th>
                        <th>Chức vụ</th>
                        <th>Ngày vào hội</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; ?>
                    @foreach ($thanhvien as $item)
                        <tr >
                            <td style="line-height: 50px;"> {{$stt++}} </td>
                            <td style="line-height: 50px;font-weight: 700;"> {{$item->stu_name}}  </td>
                            <td style="line-height: 50px;"> 
                            @if ($item->sub_role=="LCHT")
                            Chi hội trưởng
                            @elseif($item->sub_role=="LCHP")
                            Chi hội phó
                            @elseif($item->sub_role=="UV")
                            Ủy viên
                            @elseif($item->sub_role=="HV")
                            Hội viên
                            @endif
                            
                            </td>
                            <td style="line-height: 50px;">  {{ date('d-m-Y', strtotime($item->sub_created)) }} </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
           <div class="text-center">{{$thanhvien->links()}}</div> 





        </div>
    </div>
</div>
 


@endsection
@push('script')

@endpush