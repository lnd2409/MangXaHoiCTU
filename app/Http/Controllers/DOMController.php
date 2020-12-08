<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DOMController extends Controller
{
    public function getLike(Request $request)
    {
        $like=DB::table('posts as p')
        ->join('comments as c','c.p_id','p.p_id')
        ->join('likes as l','l.com_id','c.com_id')
        ->where('p.p_id',$request->l)
        ->count();
        return response()->json($like, 200);
    }
    public function getComment(Request $request)
    {
        $comment=DB::table('posts as p')
        ->join('comments as c','c.p_id','p.p_id')
        ->where('p.p_id',$request->c)
        ->count();
        return response()->json($comment, 200);
    }
    public function getView($v){
        echo $v;
        // $view=DB::table('posts as p')
        // ->where('p.p_id',$v)
        // ->value('p_view_count');
        // echo $view;
    }
}
