<?php

use Illuminate\Database\Seeder;

class clubs extends Seeder
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
        // DB::table('clubs')->insert([
        //     ['c_name'=>'Câu lạc bộ Bốn phương','c_slug'=>$this->sanitize('Câu lạc bộ Bốn phương')],
        //     ['c_name'=>'Câu lạc bộ Môi trường','c_slug'=>$this->sanitize('Câu lạc bộ Môi trường')],
        //     ['c_name'=>'Câu lạc bộ Táo xanh','c_slug'=>$this->sanitize('Câu lạc bộ Táo xanh')],
        //     ['c_name'=>'Câu lạc bộ Sức trẻ','c_slug'=>$this->sanitize('Câu lạc bộ Sức trẻ')],
        //     ['c_name'=>'Câu lạc bộ Guitar','c_slug'=>$this->sanitize('Câu lạc bộ Guitar')],
        //     ['c_name'=>'Câu lạc bộ Văn hóa nghệ thuật','c_slug'=>$this->sanitize('Câu lạc bộ Văn hóa  nghệ thuật')],
        //     ['c_name'=>'Câu lạc bộ Sinh viên khuyết tật','c_slug'=>$this->sanitize('Câu lạc bộ Sinh viên khuyết tật')],
        //     ['c_name'=>'Câu lạc bộ Hiến máu tình nguyện','c_slug'=>$this->sanitize('Câu lạc bộ Hiến máu tình nguyện')],
        //     ['c_name'=>'Câu lạc bộ Sáo','c_slug'=>$this->sanitize('Câu lạc bộ Sáo')],
        //     ['c_name'=>'Câu lạc bộ Tương lai xanh Cần Thơ','c_slug'=>$this->sanitize('Câu lạc bộ Tương lai xanh Cần Thơ')]
        // ]);


        // for($i=2;$i<=8256;$i++){
        //     $lucky=rand(0,2);
        //     if($lucky==1){
        //         DB::table('club_students')->insert([
        //             'stu_id'=>$i,
        //             'c_id'=>rand(1,10),
        //             'cs_role'=>'TV'
        //         ]);
        //         }
        // }

        for($j=1;$j<=10;$j++){
            $temp=DB::table('club_students')
            ->inRandomOrder()
            ->where('cs_role','TV')
            ->where('c_id',$j)
            ->limit(3)
            ->update([
                'cs_role'=>'UVCLB'
            ]);

            }
    }
}
