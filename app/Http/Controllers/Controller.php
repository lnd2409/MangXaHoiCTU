<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Carbon\Carbon;
class Controller extends BaseController
{
    // lấy thời gian hiện tạo
    public static function now(){
        Carbon::setlocale('vi');
        return $now = Carbon::now();
        
    }
    // tính ngày đã đăng quá 10 ngày chưa
    public function diffInDays($create){
        $ten_day=Carbon::parse($create)->diffInDays($this->now());
        if($ten_day>10){
            return false;
        }
        return true;
        
    }
    public function getDay($time,$create)
    {
        $ten_day=$this->diffInDays($create);
        if($ten_day){

            return $day[$time]=Carbon::parse($create)->diffForHumans();
        }
        else{
            return $day[$time]=$this->format_date($create);
        }
    }
    
    // format định dạng ngày tháng năm
    public function format_date($date)
    {
        return date('d-m-Y',strtotime($date));
    }
    // chuyển chuỗi thành slug
    public static function sanitize($title) {
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
    public static function getUnionStudent()
    {
        $id=\Auth::user()->students_ubs;
        
        return $id;
    }
    public static function getClubStudent()
    {
        $id=\Auth::user()->clubs;
        // dd($id);
        return $id;
    }

    public function postNoti($content,$id)
    {
        DB::table('notifications')->insert([
            'noti_content'=>$content,
            'stu_id'=>$id
        ]);
    }
    public function getReasons()
    {
        $reasons=DB::table('reasons')->orderby('reason_content')->get();
        // if(!$reasons->isNotEmpty()){
        //     $reasons='';
        // }
        return $reasons;
    }





    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
