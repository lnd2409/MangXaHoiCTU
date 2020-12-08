<?php

use Illuminate\Database\Seeder;

class union_bran extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function sanitize($title) {
        $replacement = '-';
        $map = array();
        $quotedReplacement = preg_quote($replacement, '/');
        $default = array(
            '/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|å/' => 'a',
            '/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|ë/' => 'e',
            '/ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ|î/' => 'i',
            '/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|ø/' => 'o',
            '/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|ů|û/' => 'u',
            '/ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ/' => 'y',
            '/đ|Đ/' => 'd',
            '/ç/' => 'c',
            '/ñ/' => 'n',
            '/ä|æ/' => 'ae',
            '/ö/' => 'oe',
            '/ü/' => 'ue',
            '/Ä/' => 'Ae',
            '/Ü/' => 'Ue',
            '/Ö/' => 'Oe',
            '/ß/' => 'ss',
            '/[^\s\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
            '/\\s+/' => $replacement,
            sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
        );
        //Some URL was encode, decode first
        $title = urldecode($title);
        $map = array_merge($map, $default);
        return strtolower(preg_replace(array_keys($map), array_values($map), $title));
    } 
    public function run()
    {
        {
            DB::table('union_branchs')->insert([
                ['uo_id'=>1,'ub_name'=>'Chi hội sinh viên Thủ Đức','ub_slug'=>$this->sanitize('Chi hội sinh viên Thủ Đức')],
                ['uo_id'=>1,'ub_name'=>'Chi hội sinh viên Thạnh Tân','ub_slug'=>$this->sanitize('Chi hội sinh viên Thạnh Tân')],
                ['uo_id'=>1,'ub_name'=>'Chi hội sinh viên Kiến Tường','ub_slug'=>$this->sanitize('Chi hội sinh viên Kiến Tường')],
                ['uo_id'=>1,'ub_name'=>'Chi hội sinh viên Vàm Cỏ Đông','ub_slug'=>$this->sanitize('Chi hội sinh viên Vàm Cỏ Đông')],
                ['uo_id'=>1,'ub_name'=>'Chi hội sinh viên Vàm Cỏ Tây','ub_slug'=>$this->sanitize('Chi hội sinh viên Vàm Cỏ Tây')],
                ['uo_id'=>1,'ub_name'=>'Chi hội sinh viên Long An - Hòa An','ub_slug'=>$this->sanitize('Chi hội sinh viên Long An - Hòa An')],
                
                ['uo_id'=>2,'ub_name'=>'Chi hội sinh viên Mỹ-Thành-Phước','ub_slug'=>$this->sanitize('Chi hội sinh viên Mỹ-Thành-Phước')],
                ['uo_id'=>2,'ub_name'=>'Chi hội sinh viên Gò Công Tây','ub_slug'=>$this->sanitize('Chi hội sinh viên Gò Công Tây')],
                ['uo_id'=>2,'ub_name'=>'Chi hội sinh viên Gò Công','ub_slug'=>$this->sanitize('Chi hội sinh viên Gò Công')],
                ['uo_id'=>2,'ub_name'=>'Chi hội sinh viên Cai Lậy','ub_slug'=>$this->sanitize('Chi hội sinh viên Cai Lậy')],
                ['uo_id'=>2,'ub_name'=>'Chi hội sinh viên Cái Bè','ub_slug'=>$this->sanitize('Chi hội sinh viên Cái Bè')],
                ['uo_id'=>2,'ub_name'=>'Chi hội sinh viên Chợ Gạo','ub_slug'=>$this->sanitize('Chi hội sinh viên Chợ Gạo')],
                ['uo_id'=>2,'ub_name'=>'Chi hội sinh viên Tiền Giang - Hòa An','ub_slug'=>$this->sanitize('Chi hội sinh viên Tiền Giang - Hòa An')],
                
                ['uo_id'=>3,'ub_name'=>'Chi hội sinh viên Tân Hồng','ub_slug'=>$this->sanitize('Chi hội sinh viên Tân Hồng')],
                ['uo_id'=>3,'ub_name'=>'Chi hội sinh viên Hồng Ngự','ub_slug'=>$this->sanitize('Chi hội sinh viên Hồng Ngự')],
                ['uo_id'=>3,'ub_name'=>'Chi hội sinh viên Tam Nông','ub_slug'=>$this->sanitize('Chi hội sinh viên Tam Nông')],
                ['uo_id'=>3,'ub_name'=>'Chi hội sinh viên Thanh Bình','ub_slug'=>$this->sanitize('Chi hội sinh viên Thanh Bình')],
                ['uo_id'=>3,'ub_name'=>'Chi hội sinh viên TP Cao Lãnh','ub_slug'=>$this->sanitize('Chi hội sinh viên TP Cao Lãnh')],
                ['uo_id'=>3,'ub_name'=>'Chi hội sinh viên Cao Lãnh','ub_slug'=>$this->sanitize('Chi hội sinh viên Cao Lãnh')],
                ['uo_id'=>3,'ub_name'=>'Chi hội sinh viên Châu-Sa','ub_slug'=>$this->sanitize('Chi hội sinh viên Châu-Sa')],
                ['uo_id'=>3,'ub_name'=>'Chi hội sinh viên Lấp Vò','ub_slug'=>$this->sanitize('Chi hội sinh viên Lấp Vò')],
                ['uo_id'=>3,'ub_name'=>'Chi hội sinh viên Lai Vung','ub_slug'=>$this->sanitize('Chi hội sinh viên Lai Vung')],
                ['uo_id'=>3,'ub_name'=>'Chi hội sinh viên Tháp Mười','ub_slug'=>$this->sanitize('Chi hội sinh viên Tháp Mười')],
                ['uo_id'=>3,'ub_name'=>'Chi hội sinh viên Đồng Tháp - Hòa An','ub_slug'=>$this->sanitize('Chi hội sinh viên Đồng Tháp - Hòa An')],
                
                ['uo_id'=>4,'ub_name'=>'Chi hội sinh viên Châu Thành','ub_slug'=>$this->sanitize('Chi hội sinh viên Châu Thành')],
                ['uo_id'=>4,'ub_name'=>'Chi hội sinh viên TP Bến Tre','ub_slug'=>$this->sanitize('Chi hội sinh viên TP Bến Tre')],
                ['uo_id'=>4,'ub_name'=>'Chi hội sinh viên Bình Đại','ub_slug'=>$this->sanitize('Chi hội sinh viên Bình Đại')],
                ['uo_id'=>4,'ub_name'=>'Chi hội sinh viên Ba Tri','ub_slug'=>$this->sanitize('Chi hội sinh viên Ba Tri')],
                ['uo_id'=>4,'ub_name'=>'Chi hội sinh viên Giồng Trôm','ub_slug'=>$this->sanitize('Chi hội sinh viên Giồng Trôm')],
                ['uo_id'=>4,'ub_name'=>'Chi hội sinh viên Mỏ Cày Nam','ub_slug'=>$this->sanitize('Chi hội sinh viên Mỏ Cày Nam')],
                ['uo_id'=>4,'ub_name'=>'Chi hội sinh viên Thạnh Phú','ub_slug'=>$this->sanitize('Chi hội sinh viên Thạnh Phú')],
                ['uo_id'=>4,'ub_name'=>'Chi hội sinh viên Chợ Lách','ub_slug'=>$this->sanitize('Chi hội sinh viên Chợ Lách')],
                ['uo_id'=>4,'ub_name'=>'Chi hội sinh viên Mỏ Cày Bắc','ub_slug'=>$this->sanitize('Chi hội sinh viên Mỏ Cày Bắc')],
                ['uo_id'=>4,'ub_name'=>'Chi hội sinh viên Bến Tre - Hòa An','ub_slug'=>$this->sanitize('Chi hội sinh viên Bến Tre - Hòa An')],
                
                ['uo_id'=>5,'ub_name'=>'Chi hội sinh viên TP Vĩnh Long','ub_slug'=>$this->sanitize('Chi hội sinh viên TP Vĩnh Long')],
                ['uo_id'=>5,'ub_name'=>'Chi hội sinh viên Long Hồ','ub_slug'=>$this->sanitize('Chi hội sinh viên Long Hồ')],
                ['uo_id'=>5,'ub_name'=>'Chi hội sinh viên Tam Bình','ub_slug'=>$this->sanitize('Chi hội sinh viên Tam Bình')],
                ['uo_id'=>5,'ub_name'=>'Chi hội sinh viên Mang Thít','ub_slug'=>$this->sanitize('Chi hội sinh viên Mang Thít')],
                ['uo_id'=>5,'ub_name'=>'Chi hội sinh viên Vũng Liêm','ub_slug'=>$this->sanitize('Chi hội sinh viên Vũng Liêm')],
                ['uo_id'=>5,'ub_name'=>'Chi hội sinh viên Bình Minh','ub_slug'=>$this->sanitize('Chi hội sinh viên Bình Minh')],
                ['uo_id'=>5,'ub_name'=>'Chi hội sinh viên Bình Tân','ub_slug'=>$this->sanitize('Chi hội sinh viên Bình Tân')],
                ['uo_id'=>5,'ub_name'=>'Chi hội sinh viên Trà Ôn','ub_slug'=>$this->sanitize('Chi hội sinh viên Trà Ôn')],
                ['uo_id'=>5,'ub_name'=>'Chi hội sinh viên Vĩnh Long - Hòa An','ub_slug'=>$this->sanitize('Chi hội sinh viên Vĩnh Long - Hòa An')],
                
                ['uo_id'=>6,'ub_name'=>'Chi hội sinh viên Chợ Mới','ub_slug'=>$this->sanitize('Chi hội sinh viên Chợ Mới')],
                ['uo_id'=>6,'ub_name'=>'Chi hội sinh viên An Phú-Phú Tân','ub_slug'=>$this->sanitize('Chi hội sinh viên An Phú-Phú Tân')],
                ['uo_id'=>6,'ub_name'=>'Chi hội sinh viên Châu Đốc-Tịnh Biên','ub_slug'=>$this->sanitize('Chi hội sinh viên Châu Đốc-Tịnh Biên')],
                ['uo_id'=>6,'ub_name'=>'Chi hội sinh viên Thoại Sơn-Châu Thành','ub_slug'=>$this->sanitize('Chi hội sinh viên Thoại Sơn-Châu Thành')],
                ['uo_id'=>6,'ub_name'=>'Chi hội sinh viên Long Xuyên-Tri Tôn','ub_slug'=>$this->sanitize('Chi hội sinh viên Long Xuyên-Tri Tôn')],
                ['uo_id'=>6,'ub_name'=>'Chi hội sinh viên Châu Phú-Tân Châu','ub_slug'=>$this->sanitize('Chi hội sinh viên Châu Phú-Tân Châu')],
                ['uo_id'=>6,'ub_name'=>'Chi hội sinh viên An Giang - Hòa An','ub_slug'=>$this->sanitize('Chi hội sinh viên An Giang - Hòa An')],
                ['uo_id'=>6,'ub_name'=>'Chi hội sinh viên Thoại Sơn','ub_slug'=>$this->sanitize('Chi hội sinh viên Thoại Sơn')],
                ['uo_id'=>6,'ub_name'=>'Chi hội sinh viên Châu Thành','ub_slug'=>$this->sanitize('Chi hội sinh viên Châu Thành')],
                
                ['uo_id'=>7,'ub_name'=>'Chi hội sinh viên Châu Thành','ub_slug'=>$this->sanitize('Chi hội sinh viên Châu Thành')],
                ['uo_id'=>7,'ub_name'=>'Chi hội sinh viên TP Trà Vinh','ub_slug'=>$this->sanitize('Chi hội sinh viên TP Trà Vinh')],
                ['uo_id'=>7,'ub_name'=>'Chi hội sinh viên Càng Long','ub_slug'=>$this->sanitize('Chi hội sinh viên Càng Long')],
                ['uo_id'=>7,'ub_name'=>'Chi hội sinh viên Trà Cú','ub_slug'=>$this->sanitize('Chi hội sinh viên Trà Cú')],
                ['uo_id'=>7,'ub_name'=>'Chi hội sinh viên Cầu Kè','ub_slug'=>$this->sanitize('Chi hội sinh viên Cầu Kè')],
                ['uo_id'=>7,'ub_name'=>'Chi hội sinh viên Cầu Ngang','ub_slug'=>$this->sanitize('Chi hội sinh viên Cầu Ngang')],
                ['uo_id'=>7,'ub_name'=>'Chi hội sinh viên Duyên Hải','ub_slug'=>$this->sanitize('Chi hội sinh viên Duyên Hải')],
                ['uo_id'=>7,'ub_name'=>'Chi hội sinh viên Tiểu Cần','ub_slug'=>$this->sanitize('Chi hội sinh viên Tiểu Cần')],
                ['uo_id'=>7,'ub_name'=>'Chi hội sinh viên Trà Vinh - Hòa An','ub_slug'=>$this->sanitize('Chi hội sinh viên Trà Vinh - Hòa An')],
                
                ['uo_id'=>8,'ub_name'=>'Chi hội sinh viên Ninh Kiều','ub_slug'=>$this->sanitize('Chi hội sinh viên Ninh Kiều')],
                ['uo_id'=>8,'ub_name'=>'Chi hội sinh viên Bình Thủy','ub_slug'=>$this->sanitize('Chi hội sinh viên Bình Thủy')],
                ['uo_id'=>8,'ub_name'=>'Chi hội sinh viên Cái Răng','ub_slug'=>$this->sanitize('Chi hội sinh viên Cái Răng')],
                ['uo_id'=>8,'ub_name'=>'Chi hội sinh viên Phong Điền','ub_slug'=>$this->sanitize('Chi hội sinh viên Phong Điền')],
                ['uo_id'=>8,'ub_name'=>'Chi hội sinh viên Cờ Đỏ','ub_slug'=>$this->sanitize('Chi hội sinh viên Cờ Đỏ')],
                ['uo_id'=>8,'ub_name'=>'Chi hội sinh viên Thới Lai','ub_slug'=>$this->sanitize('Chi hội sinh viên Thới Lai')],
                ['uo_id'=>8,'ub_name'=>'Chi hội sinh viên Ô Môn','ub_slug'=>$this->sanitize('Chi hội sinh viên Ô Môn')],
                ['uo_id'=>8,'ub_name'=>'Chi hội sinh viên Thốt Nốt','ub_slug'=>$this->sanitize('Chi hội sinh viên Thốt Nốt')],
                ['uo_id'=>8,'ub_name'=>'Chi hội sinh viên Vĩnh Thạnh','ub_slug'=>$this->sanitize('Chi hội sinh viên Vĩnh Thạnh')],
                ['uo_id'=>8,'ub_name'=>'Chi hội sinh viên Cần Thơ - Hòa An','ub_slug'=>$this->sanitize('Chi hội sinh viên Cần Thơ - Hòa An')],
               
                ['uo_id'=>9,'ub_name'=>'Chi hội sinh viên Châu Thành','ub_slug'=>$this->sanitize('Chi hội sinh viên Châu Thành')],
                ['uo_id'=>9,'ub_name'=>'Chi hội sinh viên Châu Thành A','ub_slug'=>$this->sanitize('Chi hội sinh viên Châu Thành A')],
                ['uo_id'=>9,'ub_name'=>'Chi hội sinh viên Phụng Hiệp','ub_slug'=>$this->sanitize('Chi hội sinh viên Phụng Hiệp')],
                ['uo_id'=>9,'ub_name'=>'Chi hội sinh viên Ngã Bảy','ub_slug'=>$this->sanitize('Chi hội sinh viên Ngã Bảy')],
                ['uo_id'=>9,'ub_name'=>'Chi hội sinh viên Long Mỹ','ub_slug'=>$this->sanitize('Chi hội sinh viên Long Mỹ')],
                ['uo_id'=>9,'ub_name'=>'Chi hội sinh viên Vị Thủy','ub_slug'=>$this->sanitize('Chi hội sinh viên Vị Thủy')],
                ['uo_id'=>9,'ub_name'=>'Chi hội sinh viên Vị Thanh','ub_slug'=>$this->sanitize('Chi hội sinh viên Vị Thanh')],
                ['uo_id'=>9,'ub_name'=>'Chi hội sinh viên Hậu Giang - Hòa An','ub_slug'=>$this->sanitize('Chi hội sinh viên Hậu Giang - Hòa An')],
               
                ['uo_id'=>10,'ub_name'=>'Chi hội sinh viên Đại Hải','ub_slug'=>$this->sanitize('Chi hội sinh viên Đại Hải')],
                ['uo_id'=>10,'ub_name'=>'Chi hội sinh viên Kế Sách','ub_slug'=>$this->sanitize('Chi hội sinh viên Kế Sách')],
                ['uo_id'=>10,'ub_name'=>'Chi hội sinh viên Mỹ Tú-Châu Thành','ub_slug'=>$this->sanitize('Chi hội sinh viên Mỹ Tú-Châu Thành')],
                ['uo_id'=>10,'ub_name'=>'Chi hội sinh viên TP Sóc Trăng','ub_slug'=>$this->sanitize('Chi hội sinh viên TP Sóc Trăng')],
                ['uo_id'=>10,'ub_name'=>'Chi hội sinh viên Ngã Năm','ub_slug'=>$this->sanitize('Chi hội sinh viên Ngã Năm')],
                ['uo_id'=>10,'ub_name'=>'Chi hội sinh viên Mỹ Xuyên-Trần Đề','ub_slug'=>$this->sanitize('Chi hội sinh viên Mỹ Xuyên-Trần Đề')],
                ['uo_id'=>10,'ub_name'=>'Chi hội sinh viên Thạnh Trị','ub_slug'=>$this->sanitize('Chi hội sinh viên Thạnh Trị')],
                ['uo_id'=>10,'ub_name'=>'Chi hội sinh viên Long Phú-Cù Lao Dung','ub_slug'=>$this->sanitize('Chi hội sinh viên Long Phú-Cù Lao Dung')],
                ['uo_id'=>10,'ub_name'=>'Chi hội sinh viên Vĩnh Châu','ub_slug'=>$this->sanitize('Chi hội sinh viên Vĩnh Châu')],
                ['uo_id'=>10,'ub_name'=>'Chi hội sinh viên Sóc Trăng - Hòa An','ub_slug'=>$this->sanitize('Chi hội sinh viên Sóc Trăng - Hòa An')],
               
                ['uo_id'=>11,'ub_name'=>'Chi hội sinh viên Hồng Dân','ub_slug'=>$this->sanitize('Chi hội sinh viên Hồng Dân')],
                ['uo_id'=>11,'ub_name'=>'Chi hội sinh viên Vĩnh Lợi','ub_slug'=>$this->sanitize('Chi hội sinh viên Vĩnh Lợi')],
                ['uo_id'=>11,'ub_name'=>'Chi hội sinh viên Giá Rai','ub_slug'=>$this->sanitize('Chi hội sinh viên Giá Rai')],
                ['uo_id'=>11,'ub_name'=>'Chi hội sinh viên TP Bạc Liêu','ub_slug'=>$this->sanitize('Chi hội sinh viên TP Bạc Liêu')],
                ['uo_id'=>11,'ub_name'=>'Chi hội sinh viên Phước Long','ub_slug'=>$this->sanitize('Chi hội sinh viên Phước Long')],
                ['uo_id'=>11,'ub_name'=>'Chi hội sinh viên Đông Hải','ub_slug'=>$this->sanitize('Chi hội sinh viên Đông Hải')],
                ['uo_id'=>11,'ub_name'=>'Chi hội sinh viên Hòa Bình','ub_slug'=>$this->sanitize('Chi hội sinh viên Hòa Bình')],
                ['uo_id'=>11,'ub_name'=>'Chi hội sinh viên Bạc Liêu - Hòa An','ub_slug'=>$this->sanitize('Chi hội sinh viên Bạc Liêu - Hòa An')],
               
                ['uo_id'=>12,'ub_name'=>'Chi hội sinh viên Tân Hiệp','ub_slug'=>$this->sanitize('Chi hội sinh viên Tân Hiệp')],
                ['uo_id'=>12,'ub_name'=>'Chi hội sinh viên Rạch Giá','ub_slug'=>$this->sanitize('Chi hội sinh viên Rạch Giá')],
                ['uo_id'=>12,'ub_name'=>'Chi hội sinh viên Hà Tiên - Kiên Hải','ub_slug'=>$this->sanitize('Chi hội sinh viên Hà Tiên - Kiên Hải')],
                ['uo_id'=>12,'ub_name'=>'Chi hội sinh viên Kiên Lương - Giang Thành','ub_slug'=>$this->sanitize('Chi hội sinh viên Kiên Lương - Giang Thành')],
                ['uo_id'=>12,'ub_name'=>'Chi hội sinh viên Phú Quốc','ub_slug'=>$this->sanitize('Chi hội sinh viên Phú Quốc')],
                ['uo_id'=>12,'ub_name'=>'Chi hội sinh viên Giồng Riềng','ub_slug'=>$this->sanitize('Chi hội sinh viên Giồng Riềng')],
                ['uo_id'=>12,'ub_name'=>'Chi hội sinh viên Gò Quao','ub_slug'=>$this->sanitize('Chi hội sinh viên Gò Quao')],
                ['uo_id'=>12,'ub_name'=>'Chi hội sinh viên Vĩnh Thuận','ub_slug'=>$this->sanitize('Chi hội sinh viên Vĩnh Thuận')],
                ['uo_id'=>12,'ub_name'=>'Chi hội sinh viên U Minh Thượng','ub_slug'=>$this->sanitize('Chi hội sinh viên U Minh Thượng')],
                ['uo_id'=>12,'ub_name'=>'Chi hội sinh viên An Biên','ub_slug'=>$this->sanitize('Chi hội sinh viên An Biên')],
                ['uo_id'=>12,'ub_name'=>'Chi hội sinh viên An Minh','ub_slug'=>$this->sanitize('Chi hội sinh viên An Minh')],
                ['uo_id'=>12,'ub_name'=>'Chi hội sinh viên Châu Thành','ub_slug'=>$this->sanitize('Chi hội sinh viên Châu Thành')],
                ['uo_id'=>12,'ub_name'=>'Chi hội sinh viên Hòn Đất','ub_slug'=>$this->sanitize('Chi hội sinh viên Hòn Đất')],
                ['uo_id'=>12,'ub_name'=>'Chi hội sinh viên Kiên Giang - Hòa An','ub_slug'=>$this->sanitize('Chi hội sinh viên Kiên Giang - Hòa An')],
               
                ['uo_id'=>13,'ub_name'=>'Chi hội sinh viên TP Cà Mau','ub_slug'=>$this->sanitize('Chi hội sinh viên TP Cà Mau')],
                ['uo_id'=>13,'ub_name'=>'Chi hội sinh viên Thới Bình','ub_slug'=>$this->sanitize('Chi hội sinh viên Thới Bình')],
                ['uo_id'=>13,'ub_name'=>'Chi hội sinh viên U Minh','ub_slug'=>$this->sanitize('Chi hội sinh viên U Minh')],
                ['uo_id'=>13,'ub_name'=>'Chi hội sinh viên Năm Căn','ub_slug'=>$this->sanitize('Chi hội sinh viên Năm Căn')],
                ['uo_id'=>13,'ub_name'=>'Chi hội sinh viên Cái Nước-Phú Tân','ub_slug'=>$this->sanitize('Chi hội sinh viên Cái Nước-Phú Tân')],
                ['uo_id'=>13,'ub_name'=>'Chi hội sinh viên Đầm Dơi','ub_slug'=>$this->sanitize('Chi hội sinh viên Đầm Dơi')],
                ['uo_id'=>13,'ub_name'=>'Chi hội sinh viên Ngọc Hiển','ub_slug'=>$this->sanitize('Chi hội sinh viên Ngọc Hiển')],
                ['uo_id'=>13,'ub_name'=>'Chi hội sinh viên Trần Văn Thời','ub_slug'=>$this->sanitize('Chi hội sinh viên Trần Văn Thời')],
                ['uo_id'=>13,'ub_name'=>'Chi hội sinh viên Cà Mau - Hòa An','ub_slug'=>$this->sanitize('Chi hội sinh viên Cà Mau - Hòa An')],
                ['uo_id'=>13,'ub_name'=>'Chi hội sinh viên Thanh Hóa','ub_slug'=>$this->sanitize('Chi hội sinh viên Thanh Hóa')],
                ['uo_id'=>13,'ub_name'=>'Chi hội sinh viên Hà Tĩnh','ub_slug'=>$this->sanitize('Chi hội sinh viên Hà Tĩnh')]
    
            ]);
        }
    }
}
