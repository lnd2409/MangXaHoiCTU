<script>
    $(document).ready(function () {
        var hocky=null;
        var nienkhoa=null;
        var mssv=$('#stu_code').html().trim();
        // lấy năm học hiện hành
        $.ajax({
                url:"{{ route('SemesterYear') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
                type: "GET", // phương thức gửi dữ liệu.
                dataType: "JSON",
                success:function(response){ //dữ liệu nhận về
                hocky=response.hocky;
                nienkhoa=response.nienkhoa;
                }
            });
            // lấy lượt like
        $.ajax({
                url:"{{ route('getLike') }}", 
                type: "GET",
                dataType: "JSON",
                data:{hocky:hocky,nienkhoa:nienkhoa,mssv:mssv},
                
                success:function(response){ 
                if(response[0]!=undefined){
                    

                    document.getElementById('luotLike').innerHTML=response[0].TongLuotLike;
                }
                }
            });
            $.ajax({
                url:"{{ route('Posted') }}", 
                type: "GET",
                dataType: "JSON",
                data:{mssv:mssv},
                
                success:function(response){ 
                if(response[0]!=undefined){
                    

                    document.getElementById('baiDaDang').innerHTML=response.length;
                }
                }
            });
            $.ajax({
                url:"{{ route('Liked') }}", 
                type: "GET",
                dataType: "JSON",
                data:{mssv:mssv},
                
                success:function(response){ 
                if(response[0]!=undefined){
                    

                    document.getElementById('daLike').innerHTML=response.length;
                }
                }
            });
            $.ajax({
                url:"{{ route('JoinedClub') }}", 
                type: "GET",
                dataType: "JSON",
                data:{mssv:mssv},
                
                success:function(response){ 
                    if(response[0]!=undefined){
                        for(let i = 0; i < response.length; i++) {
                            let data="<tr><td>"+(i+1)+"</td><td>"+response[i].c_name+"</td><td>"+response[i].cs_created+"</td></tr>";
                            
                            $("#club").append(data);
                        }
                    }
                    

                }
            });
            $.ajax({
                url:"{{ route('ShareItem') }}", 
                type: "GET",
                dataType: "JSON",
                data:{mssv:mssv},
                
                success:function(response){ 
                    if(response[0]!=undefined){
                        for(let i = 0; i < response.length; i++) {
                            let data="<tr><td>"+(i+1)+"</td><td>"+response[i].type_name+"</td><td>"+response[i].item_name+"</td><td>"+response[i].item_created+"</td></tr>";
                            
                            $("#shareitem").append(data);
                        }
                    }
                    

                }
            });
            $.ajax({
                url:"{{ route('PostForum') }}", 
                type: "GET",
                dataType: "JSON",
                data:{mssv:mssv},
                
                success:function(response){ 
                    console.log(response);
                    if(response[0]!=undefined){
                        for(let i = 0; i < response.length; i++) {
                            let data="<tr><td>"+(i+1)+"</td><td>"+response[i].school_year_name+" "+response[i].semester_name+"</td><td>"+response[i].sub_code+"</td><td>"+response[i].sub_name+"</td><td>"+response[i].tongBaiDang+"</td></tr>";
                            
                            $("#postforum").append(data);
                        }
                    }
                    

                }
            });
    });
</script>