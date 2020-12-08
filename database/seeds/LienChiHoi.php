<?php

use Illuminate\Database\Seeder;
use DB;
class LienChiHoi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        function utf8tourl($text){
            $text = strtolower(utf8convert($text));
            $text = str_replace( "ß", "ss", $text);
            $text = str_replace( "%", "", $text);
            $text = preg_replace("/[^_a-zA-Z0-9 -] /", "",$text);
            $text = str_replace(array('%20', ' '), '-', $text);
            $text = str_replace("----","-",$text);
            $text = str_replace("---","-",$text);
            $text = str_replace("--","-",$text);
                return $text;
        }
        $lienchihoi = [

            [
                'uo_name' => 'Liên chi hội sinh viên Long An',
                'uo_slug' => utf8tourl('Liên chi hội sinh viên Long An')
            ],
            [
                'uo_name' => 'Liên chi hội sinh viên Tiền Giang',
                'uo_slug' => utf8tourl('Liên chi hội sinh viên Tiền Giang')
            ],

            [
                'uo_name' => 'Liên chi hội sinh viên Tiền Giang',
                'uo_slug' => utf8tourl('Liên chi hội sinh viên Tiền Giang')
            ],

            [
                'uo_name' => 'Liên chi hội sinh viên Bến Tre',
                'uo_slug' => utf8tourl('Liên chi hội sinh viên Bến Tre')
            ],

            [
                'uo_name' => 'Liên chi hội sinh viên Vĩnh Long',
                'uo_slug' => utf8tourl('Liên chi hội sinh viên Vĩnh Long')
            ],

            [
                'uo_name' => 'Liên chi hội sinh viên An Giang',
                'uo_slug' => utf8tourl('Liên chi hội sinh viên An Giang')
            ],

            [
                'uo_name' => 'Liên chi hội sinh viên Trà Vinh',
                'uo_slug' => utf8tourl('Liên chi hội sinh viên Trà Vinh')
            ],

            [
                'uo_name' => 'Liên chi hội sinh viên Cần Thơ',
                'uo_slug' => utf8tourl('Liên chi hội sinh viên Cần Thơ')
            ],

            [
                'uo_name' => 'Liên chi hội sinh viên Hậu Giang',
                'uo_slug' => utf8tourl('Liên chi hội sinh viên Hậu Giang')
            ],

            [
                'uo_name' => 'Liên chi hội sinh viên Sóc Trăng',
                'uo_slug' => utf8tourl('Liên chi hội sinh viên Sóc Trăng')
            ],

            [
                'uo_name' => 'Liên chi hội sinh viên Bạc Liêu',
                'uo_slug' => utf8tourl('Liên chi hội sinh viên Bạc Liêu')
            ],

            [
                'uo_name' => 'Liên chi hội sinh viên Kiên Giang',
                'uo_slug' => utf8tourl('Liên chi hội sinh viên Kiên Giang')
            ],

            [
                'uo_name' => 'Liên chi hội sinh viên Cà Mau',
                'uo_slug' => utf8tourl('Liên chi hội sinh viên Cà Mau')
            ],
    ];
    DB::table('union_organizations')->insert($lienchihoi);
    }
}
