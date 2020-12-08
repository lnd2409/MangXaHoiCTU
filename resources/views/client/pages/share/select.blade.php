@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Chia sẻ
@endsection
@push('css')
<style>
    .style-color {
        font-size: 16px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        margin: 10px 0;
    }

    div#myModal {
        width: 65%;
        height: 500px;
        margin: 113px auto;
        margin-left: 359px;
    }

    #close {
        font-size: 52px;
        margin-right: 134px;
        margin-top: -14px;
    }

    .card {
        width: 100% !important;
        text-align: center;
    }

    .card img {
        width: 60%;

    }
</style>
@endpush
@section('content')

<div class="row">
    <!-- Blog Column -->
    <div class="col-md-12 o-giua" style="height: auto;">
        <div class="row blogu">
            <div id="content" style="margin-top: 20px; margin-left: 20px; margin-right: 20px;">
                <h1 class="page-header sidebar-title">
                    Danh mục chia sẻ
                </h1>
                <div class="row">
                    @forelse ($type as $item)
                    <div class="col-md-2">
                        <a href="{{route('share.type',$item->type_slug)}}">
                            <div class="card" style="width: 18rem;">
                                <img src="{{asset($item->type_image)}}" class="card-img-top" alt="{{$item->type_name}}" style="border: 2px solid white;
                                border-radius: 20% !important;">
                                <div class="card-body">
                                    <p class="card-text" style="font-size:14px;color: #326fab;font-weight: bold; ">{{$item->type_name}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty <p  ></p>Không có dữ liệu</p>
                    @endforelse
                </div>
            </div>
        </div>
        <hr>
    </div>
    <hr>
    <hr>
    <div class="col-md-12 o-giua" style="margin-top: 20px; height: auto; padding-bottom: 50px;">
        <h1 class="page-header sidebar-title">
            Bài viết gần đây
        </h1>
        @foreach ($lastedPost as $item)
            <div class="col-md-3" style="margin-bottom: 20px">
                <div class="card" style="width: 20rem; border: 2px solid silver; padding: 20px; background-color: white;">
                    <img class="image" data-id="{!!$item->item_id!!}" id="myImg{!!$item->item_id!!}"
                        src="{{asset($item->item_avatar)}}" class="getimg" class="img-responsive card-img-top"
                        alt="{{asset($item->item_avatar)}}" style="width:200px; height:150px;">
                    <div class="card-body">
                        <h5 class="card-title style-color" style="text-transform:capitalize;">{{$item->item_title}}
                        </h5>
                        <p style="font-size:14px;color: #326fab;font-weight: bold;">{{ $item->type_name }}</p>
                        <a href="{{route('share.show',$item->item_slug)}}" class="style-color"> Xem chi tiết...</a>
                        <span style="float: right"><i class="fa fa-eye" aria-hidden="true"></i>
                            {{$item->item_view_count}}</i></span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-md-12 o-giua"> {{$lastedPost->links()}} </div>
</div>

@endsection
@push('script')
<script>
    $('.image').click(function (e) {
        e.preventDefault();
        var id =$(this).attr("data-id");
        // Get the modal
        ;

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("myImg"+id);
        var modalImg = document.getElementById("img01");
        $('#myModal').show();
        modalImg.src = this.src;



        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        // img.click(){
        //     $('#myModal').hidden();
        // }
        $('#img01').click(function (e) {
            e.preventDefault();
            // alert("tat");
            $('#myModal').hide();
        });
    });

</script>
@endpush
