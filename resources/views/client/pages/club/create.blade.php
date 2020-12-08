@extends('client.client')

{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Đặt câu hỏi
@endsection
@push('css')
<style>
</style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12 ben-trai">
            <form action="{{route('club.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <table class="table table-responsive borderless text-right">
                    <tr>
                        <td>Chọn clb</td>
                        <td>
                            <select name="club" id="" class="form-control" style="color: #555;">
                                @foreach ($club as $item)

                                <option value="{{$item->c_id}}">{{$item->c_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Chọn ảnh<red-star></red-star>
                        </td>
                        <td><img id="image" alt="Chọn hình đại diện" style="max-height: 185px;
                            float: left;
                            width: 230px;" src="https://via.placeholder.com/230x185" />

                    </tr>
                    <tr>
                        <td></td>
                        <td><label for="avatar" style="float: left">Chọn ảnh đại diện của tin...</label>
                            <input type="file" name="avatar" id="avatar" accept="image/*" style="display:none;"
                                onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                        </td>
                    </tr>
                    <tr>
                        <td style="white-space: nowrap;">Tiêu đề <red-star></red-star>
                        </td>
                        <td><input type="text" class="form-control" name="title" required>
                            <br></td>
                    </tr>
                    <br>
                    <tr>
                        <td style="white-space: nowrap;">Nội dung <red-star></red-star>
                        </td>
                        <td>
                            <textarea name="content" id="" class="tiny " cols="30" rows="20"></textarea>

                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: left">
                            <button type="submit" class="btn btn-ctu">Đăng bài</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="col-md-1 clear-center"></div>
        @include('client.pages.club.sidebar')
    </div>
@endsection
@push('script')

@endpush
