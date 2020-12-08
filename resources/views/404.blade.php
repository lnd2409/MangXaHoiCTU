@extends('client.client')
@push('css')
<style>

</style>
@endpush
{{-- Thêm khúc này để có trang tiêu đề nha --}}
@section('title')
Yêu cầu tham gia
@endsection

@section('content')
<center>

    <h1>404</h1>
    <button onclick="window.location.href='{{route('forum')}}'" class="btn btn-secondary">Trở lại </button>
</center>
<br>
<br>
@endsection