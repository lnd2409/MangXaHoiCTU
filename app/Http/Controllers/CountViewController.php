<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CountViewController extends Controller
{
    public function increase_post($check,$p_id)
    {
        DB::raw("");
        DB::table('posts')
        ->where('p_id',$p_id)
        ->update([
            'p_view_count'=>DB::raw( 'p_view_count +1' )
        ]);

    }
    public function increase_union($check,$up_id)
    {
        
        DB::table('union_posts')
        ->where('up_id',$up_id)
        ->update([
            'up_view_count'=>DB::raw( 'up_view_count +1' )
        ]);

    }
    public function increase_club($check,$cp_id)
    {
        
        DB::table('club_posts')
        ->where('cp_id',$cp_id)
        ->update([
            'cp_view_count'=>DB::raw( 'cp_view_count +1' )
        ]);

    }
    public function increase_item($check,$item_id)
    {
        
        DB::table('items')
        ->where('item_id',$item_id)
        ->update([
            'item_view_count'=>DB::raw( 'item_view_count +1' )
        ]);

    }
    public function check($p_id,$up_id,$cp_id,$item_id)
    {
        $id=\Auth::id();
        //nếu là xem bài trong diễn đàn
        if($p_id){

            $check=DB::table('count_view_posts')->where('p_id',$p_id)
            ->first();
            if(!$check){
                DB::table('count_view_posts')
                ->insert([
                    'stu_id'=>$id,
                    'p_id'=>$p_id
                ]);
                $this->increase_post($check,$p_id);
            }
        }
        //nếu là xem bài trong chi hội
        elseif($up_id){

            $check=DB::table('count_view_unions')->where('up_id',$up_id)
            ->first();
            if(!$check){
                DB::table('count_view_unions')
                ->insert([
                    'stu_id'=>$id,
                    'up_id'=>$up_id
                ]);
                $this->increase_union($check,$up_id);
            }
        }
        //nếu là xem bài trong club
        elseif($cp_id){

            $check=DB::table('count_view_clubs')->where('cp_id',$cp_id)
            ->first();
            if(!$check){
                DB::table('count_view_clubs')
                ->insert([
                    'stu_id'=>$id,
                    'cp_id'=>$cp_id
                ]);
                $this->increase_club($check,$cp_id);
            }
        }
        //nếu là xem bài trong chia sẻ
        elseif($item_id){

            $check=DB::table('count_view_items')->where('item_id',$item_id)
            ->first();
            if(!$check){
                DB::table('count_view_items')
                ->insert([
                    'stu_id'=>$id,
                    'item_id'=>$item_id
                ]);
                $this->increase_item($check,$item_id);
            }
        }
    }
    
}
