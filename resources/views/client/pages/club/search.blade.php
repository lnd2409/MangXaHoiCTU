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
            url: "{{route('club.search')}}",
            data: {content:content},
            dataType: "JSON",
            success: function (response) {
                var url='{{ route("club.show", ":id") }}';
                var asset='{{ asset(":id") }}';
                var inner='';
                response.forEach(element => {
                    
                    url = url.replace(':id', element['cp_slug']);
                    asset = asset.replace(':id', element['cp_avatar']);

                    
                    inner+="<div class='col-md-12'>";
                    inner+="<div class='col-md-4'>";
                    inner+="<div class='blog-thumb'>";
                    inner+="<a href='"+url+"'>";
                    inner+="<img class='img-responsive' src='"+asset+"' alt='photo'>";
                    inner+="</a>";
                    inner+="</div>";
                    inner+="</div>";
                    inner+="<div class='col-md-8'>";
                    inner+="<h2 class='blog-title'>";
                    inner+="<a href='"+url+"'>"+element['cp_title']+"</a>";
                    inner+="</h2>";
                    inner+="<p>";
                    inner+="<i class='fa fa-calendar-o'></i>"+element['day'];
                    inner+="<span class='comments-padding'></span>";
                    inner+="<i class='fa fa-eye' aria-hidden='true'></i> "+element['cp_view_count']+"</i>";
                    inner+="<h4>"+element['c_name']+"</h4>";
                    inner+=" </p>";
                    inner+="</div>";
                    inner+="<div class='col-md-12'>&nbsp;</div>";
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