<div class="blog-sidebar">
    <div class="input-group searchbar">

        <form action="#" id="frmSearch">
            <div class="form-group">

                <input type="text" class="form-control searchbar" id="search" placeholder="Tìm kiếm...">
                {{-- <span class="input-group-btn"> --}}
                <button class="btn btn-default" type="submit" id="btnSearch">Tìm kiếm</button>
                {{-- </span> --}}
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
            url: "{{route('forum.search')}}",
            data: {content:content},
            dataType: "JSON",
            success: function (response) {
                var url='{{ route("forum.show", ":id") }}';
                var inner='';
                response.forEach(element => {
                    url = url.replace(':id', element['p_slug']);
                    inner+="<h2 class='blog-title'><a href='"+url+"'>"+element['p_title']+"</a></h2>";
                    inner+="<p>";
                    inner+="<i class='fa fa-thumbs-o-up' aria-hidden='true'>"+element['likes']+"</i>";
                    inner+="<span class='comments-padding'></span>";
                    inner+="<i class='fa fa-comment'>"+element['comments']+"</i>";
                    inner+="<span class='comments-padding'></span>";
                    inner+="<i class='fa fa-eye' aria-hidden='true'>"+element['p_view_count']+"</i>";

                    inner+="<span class='comments-padding'></span>";
                    inner+="<i class='fa fa-calendar-o'></i>"+element['day'];
                    inner+="</p>";
                    inner+="<hr>";
                console.log(element);
                });
                    $("#content").html(inner);
                console.log(response);

            }
        });
    });
</script>
@endpush
