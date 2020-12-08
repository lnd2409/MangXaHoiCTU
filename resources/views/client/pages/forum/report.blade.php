<div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class=" modal-content">
            <form id="frmReport">
                {{-- <form action="{{route('report.store')}}" method="POST" id="frmReport">
                @csrf --}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title modal-lg" id="exampleModalLabel">Báo cáo bình luận</h5>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="post" value="1" readonly id="idenComment">
                    @foreach ($reason as $item)

                    <input type="checkbox" class="limit-checkbox" name="reason[]" value={{$item->reason_id}}
                        id="{{$item->reason_id}}">
                    <label for="{{$item->reason_id}}">{{$item->reason_content}}</label><br>

                    @endforeach

                    <br>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Gửi</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('css')
<style>
    .modal-lg {
        width: 450px !important;
        margin: auto;
        height: 100%;
        width: 100%;
        align-items: center;
    }
</style>
@endpush
@push('script')
<script>
    var limit = 3;
    $('input.limit-checkbox').on('change', function(evt) {
    if($(this).siblings(':checked').length >= limit) {
           this.checked = false;
           alert("Chỉ có thể chọn tối đa 3 lý do!");
        }
    });
</script>
<script>
    $(document).ready(function(){
        
        $('.clickModal').click(function(e) {
            $("#idenComment").val($(this).attr('data-modal'));
        });

        $("#frmReport").submit(function(e){
            
            e.preventDefault(); 
            var id=$('#idenComment').val();
            var reason="2";
            var reason = { 'reason[]' : []};
            $(":checked").each(function() {
                reason['reason[]'].push($(this).val());
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('report.store')}}",
                data: {id:id,reason:reason},
                dataType: "json",
                success: function (response) {
                    $(".close").click();
                    if(response=='error'){
                        alert('có lỗi xảy ra, vui lòng thử lại');
                    }
                },
            });
        });
    });
</script>
@endpush