<?php

use Illuminate\Database\Seeder;

class union_organ extends Seeder
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
        DB::table('union_organizations')->insert([
            ['uo_id'=>1,'uo_name'=>'Liên chi hội sinh viên Long An','uo_slug'=>$this->sanitize('Liên chi hội sinh viên Long An')],
            ['uo_id'=>2,'uo_name'=>'Liên chi hội sinh viên Tiền Giang','uo_slug'=>$this->sanitize('Liên chi hội sinh viên Tiền Giang')],
            ['uo_id'=>3,'uo_name'=>'Liên chi hội sinh viên Đồng Tháp','uo_slug'=>$this->sanitize('Liên chi hội sinh viên Đồng Tháp')],
            ['uo_id'=>4,'uo_name'=>'Liên chi hội sinh viên Bến Tre','uo_slug'=>$this->sanitize('Liên chi hội sinh viên Bến Tre')],
            ['uo_id'=>5,'uo_name'=>'Liên chi hội sinh viên Vĩnh Long','uo_slug'=>$this->sanitize('Liên chi hội sinh viên Vĩnh Long')],
            ['uo_id'=>6,'uo_name'=>'Liên chi hội sinh viên An Giang','uo_slug'=>$this->sanitize('Liên chi hội sinh viên An Giang')],
            ['uo_id'=>7,'uo_name'=>'Liên chi hội sinh viên Trà Vinh','uo_slug'=>$this->sanitize('Liên chi hội sinh viên Trà Vinh')],
            ['uo_id'=>8,'uo_name'=>'Liên chi hội sinh viên Cần Thơ','uo_slug'=>$this->sanitize('Liên chi hội sinh viên Cần Thơ')],
            ['uo_id'=>9,'uo_name'=>'Liên chi hội sinh viên Hậu Giang','uo_slug'=>$this->sanitize('Liên chi hội sinh viên Hậu Giang')],
            ['uo_id'=>10,'uo_name'=>'Liên chi hội sinh viên Sóc Trăng','uo_slug'=>$this->sanitize('Liên chi hội sinh viên Sóc Trăng')],
            ['uo_id'=>11,'uo_name'=>'Liên chi hội sinh viên Bạc Liêu','uo_slug'=>$this->sanitize('Liên chi hội sinh viên Bạc Liêu')],
            ['uo_id'=>12,'uo_name'=>'Liên chi hội sinh viên Kiên Giang','uo_slug'=>$this->sanitize('Liên chi hội sinh viên Kiên Giang')],
            ['uo_id'=>13,'uo_name'=>'Liên chi hội sinh viên Cà Mau','uo_slug'=>$this->sanitize('Liên chi hội sinh viên Cà Mau')]
        ]);
    }
}
