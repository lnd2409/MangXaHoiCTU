<div class="blog-sidebar">
    <div class="input-group searchbar">
        <form action="#" id="frmSearch">
            <div class="form-group">
                <input type="text" class="form-control searchbar" id="search" placeholder="Tìm kiếm...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="btnSearch">Tìm kiếm</button>
                </span>
            </div>
        </form>
    </div><!-- /input-group -->
</div>
@push('script')
<script>
    $("#btnSearch").click(function (e) {
        e.preventDefault();

    var content=$('#search').val();

        $.ajax({
            type: "GET",
            url: "{{route('share.search')}}",
            data: {content:content},
            dataType: "JSON",
            success: function (response) {
                var url='{{ route("share.show", ":id") }}';
                var asset='{{ asset(":id") }}';
                var inner='';
                response.forEach(element => {

                    url = url.replace(':id', element['item_slug']);
                    asset = asset.replace(':id', element['item_avatar']);

                    inner+="<div class='col-md-3'>";
                    inner+="<div class='card' style='width: 18rem;'>";
                    inner+="<a href='"+url+"'>";
                    inner+="<img src='"+asset+"' class='img-responsive card-img-top' alt='"+asset+"'>";
                    inner+="</a>";
                    inner+="<span>"+element['day']+"</span>";
                    inner+="<span style='float: right'>";


                    inner+="<i class='fa fa-eye' aria-hidden='true'></i>"+element['item_view_count']+"</i>";
                    inner+="</span>";
                    inner+=" <div class='card-body'>";
                    inner+="<a href='"+url+"'>";
                    inner+="<h4>"+element['item_title']+"</h4>";
                    inner+="</a>";
                    inner+="<ul style='padding-left: 0px;'>";
                    inner+="<li>"+parseFloat(element['item_price']).toLocaleString('en-US');+" đ</li>";
                    inner+="<li>"+element['item_phone']+"</li>";
                    inner+="<li>"+element['item_name']+"</li>";
                    inner+="</ul>";
                    inner+="</div>";
                    inner+="</div>";
                    inner+="</div>";




                // console.log(element);
                });
                    $("#content").html(inner);
                // console.log(response);

            }
        });
    });
</script>
@endpush
