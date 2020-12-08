<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use DB;
use Carbon\Carbon;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //trả lời bình luận
    public function repcomment(Request $request)
    {
        $date = Carbon::now();
        $comment['com_content']= $request->com_repcontent;
        $comment['com_created']= $date;
        $comment['stu_id']= $request->st_id;
        $comment['p_id']= $request->p_id;
        $comment['com_idrep']=$request->com_id;

        $result = DB::table('comments')->insert($comment);
        if($result)
        {
           return redirect()->back();
        }
    }

    //Cập nhập
    public function getcomment($id)
    {
        $comupdate= DB::table('comments')->where('com_id',$id)->get();
        return view('client.pages.forum.single',compact(['comupdate']));
    }

    //bình luận --có thêm cột trong bảng bình luận, nhớ chạy lại migrate, không thì insert DB mới trong file doc
    public function store(Request $request)
    {
        $date = Carbon::now();
        $comment['com_content']= $request->com_content;
        $comment['com_created']= $date;
        $comment['stu_id']= $request->st_id;
        $comment['p_id']= $request->p_id;
    

       

        $result = DB::table('comments')->insert($comment);
        if($result)
        {
           return redirect()->back();
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    //thích
    public function Ajaxlike(Request $request)
    {
        $stu_id_cmt = $request->stu_id_cmt;
        $stu= Auth::guard('student')->id();
        $com_id=$request->com_id;
        $data['stu_id']=$stu;
        $data['com_id']=$com_id;
        $data['l_status']=1;
        
        $status['l_status']=0;
        $status1['l_status']=1;

       

        if($stu != $stu_id_cmt)
        {
            $get =DB::table('likes')
            ->where('stu_id',$stu)
            ->where('com_id',$com_id)
            ->first();
            if($get!= null)
            {
                if($get->l_status == 0)
                {
                    DB::table('likes')
                    ->where('stu_id',$stu)
                    ->where('com_id',$com_id)
                    ->update($status1);
                    
                    $count= count(DB::table('likes as l')
                    ->where('l.com_id',$com_id)
                    ->where('l_status',1)
                    ->get());
                    if($count==0){
                        $count='';
                    }

                    return response()->json(["data"=>$count], 200);
                }
                else if($get->l_status == 1)
                {
                    DB::table('likes')
                    ->where('stu_id',$stu)
                    ->where('com_id',$com_id)
                    ->update($status);

                    $count= count(DB::table('likes as l')
                    ->where('l.com_id',$com_id)
                    ->where('l_status',1)
                    ->get());

                    if($count==0){
                        $count='';
                    }
                    return response()->json(["data"=>$count], 200);
                }
            }
            else
            {
                DB::table('likes')->insert($data);
                $count= count(
                    DB::table('likes as l')
                        ->where('l.com_id',$com_id)
                        ->where('l_status',1)
                        ->get()
                    );
                if($count==0){
                    $count='';
                }
                
                return response()->json(["data"=>$count], 200);
            }
          
        }
        // else
        // {
        //     return response()->json(["data"=>'Khong cho like cmt cua minh'], 200);
        // }

       




    }
  


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroycmt(Request $request)
    {
        \DB::table('comments')->where('com_id',$request->com_id)->delete();
        return redirect()->back();
    }
}
