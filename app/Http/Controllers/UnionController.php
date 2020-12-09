<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Auth;
class UnionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get subject of user
        $union=$this->getUnionStudent();
        $blog=[];
        
        // dd(Auth::guard('student')->id());
        $ub_branch = DB::table('students_ub as ub')
        ->join('union_branchs as br','br.ub_id','ub.ub_id')
        ->where('ub.stu_id',Auth::guard('student')->id())
        ->first();

        // dd($ub_branch);
        $chihoi = DB::table('students_ub as ub')
        ->join('students as st','st.stu_id','ub.stu_id')
        ->where('ub.ub_id',$ub_branch->ub_id)->get();

        foreach($chihoi as $val){
            if($val->sub_role =="LCHT")
            {
                $lcht=$val->stu_id;
            }

        }

        // dd($lcht);



        if($union->isNotEmpty()){

            $blog=\DB::table('union_posts')
            ->join('students','students.stu_id','union_posts.stu_id')
            ->where('ub_id',$union[0]->ub_id)
            ->paginate(10);
            $now=$this->now();

            foreach($blog as $item)
            $item->ngaydang=$this->getDay($item->up_id,$item->up_created);
            return view('client.pages.union.index',compact('union','blog','chihoi','ub_branch','lcht'));
        }
        else{
            return redirect('/404');
        }
        // dd($blog);
        // $subject=app(\App\Http\Controllers\QuestionController::class)->getSubjectsStudent();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd(\Auth::id());
        $union=$this->getUnionStudent();
        // dd($union);
        $union=$union[0];
        // dd($union);
        return view('client.pages.union.create',compact('union'));
    }
    public function store(Request $request)
    {
        $id=\DB::table('union_posts')->max('up_id');
        $title=$this->sanitize($request->title);
        $slug=$title.'.'.$request->union.'&'.($id+1);
        if ($request->hasFile('avatar')) {
            //lưu filed
            $file=$request->file('avatar')->getClientOriginalName();
            $type_file = \File::extension($file);
            $name_file=$slug.'.'.$type_file;
            $request->file('avatar')->move(
                public_path('/img/union_post/'), //nơi cần lưu
                $name_file);
            \DB::table('union_posts')->insert([
                'stu_id'=>\Auth::id(),
                'ub_id'=>$request->union,
                'up_title'=>$request->title,
                'up_avatar'=>'img/union_post/'.$name_file,
                'up_slug'=>$slug,//kết hợp id môn và id bài viết
                'up_content'=>$request->content,
            ]);
        }
        return redirect()->route('union')->with('success','Đã thêm thành công');
    }

   


    public function UpdatePost(Request $request)
    {
        $data['up_title'] = $request->uptitle;
        $data['up_content'] = $request->upcontent;

        // dd($request->up11_id);
        if ($request->hasFile('upavatar')) {
            //lưu filed
            // dd('co hinh');
            $file=$request->file('upavatar')->getClientOriginalName();
            $type_file = \File::extension($file);
            $request->file('cpavatar')->move(
                public_path('/img/union_post/'), //nơi cần lưu
                $file);
            $data['cp_avatar'] ='img/club_post/'.$file;
           // dd($request->cp11_id);
           DB::table('union_posts')->where('up_id',$request->up11_id)->update($data);
           return redirect()->back();
        }
        else
        {
            // dd($request->cp11_id);
            DB::table('union_posts')->where('up_id',$request->up11_id)->update($data);
            return redirect()->back();
        }
      
        
    }


    public function AjaxGetValue(Request $request)
    {
        if($request->ajax()){

            $data = DB::table('union_posts')->where('up_id',$request->up_id)->first();
            return response()->json($data, 200);
        }
    }








    public function show($slug)
    {
        $post=DB::table('union_posts as p')
        ->join('students_ub as sub','sub.ub_id','p.ub_id')
        ->join('students as s','s.stu_id','p.stu_id')
        ->join('union_branchs as ub','ub.ub_id','p.ub_id')
        ->where('up_slug',$slug)
        ->first();
        // dd($post);

        $chihoi = DB::table('students_ub as ub')
        ->join('students as st','st.stu_id','ub.stu_id')
        ->where('ub.ub_id',$post->ub_id)->get();
        // dd($chihoi);

        $day='';
        if($post){

            $day=$this->getDay($post->up_id,$post->up_created);
        }
        // đếm lượt xem
        app(\App\Http\Controllers\CountViewController::class)->check(false,$post->up_id,false,false);
        $comment = DB::table('comments')
        ->join('students','students.stu_id','comments.stu_id')
        ->OrderBy('com_id','DESC')->get();
        // dd($comment);
        return view('client.pages.union.single',compact('post','day','chihoi','comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request)
    {
        $date = Carbon::now();
        $comment['com_content']= $request->com_content;
        $comment['com_created']= $date;
        $comment['stu_id']= $request->st_id;
        $comment['up_id']= $request->up_id;

        // dd($comment);


        $result = DB::table('comments')->insert($comment);
        if($result)
        {
           return redirect()->back();
        }


    }
    public function commentrep(Request $request)
    {
        $date = Carbon::now();
        $comment['com_content']= $request->com_content;
        $comment['com_created']= $date;
        $comment['stu_id']= $request->st_id;
        $comment['up_id']= $request->up_id;

        // dd($comment);


        $result = DB::table('comments')->insert($comment);
        if($result)
        {
           return redirect()->back();
        }


    }

    

    //danh sách thành viên
    public function ListMember($id)
    {

        $chihoi = DB::table('union_branchs')
        ->where('ub_id',$id)->first();

        $thanhvien = DB::table('students_ub as ub')
        ->join('students as st','st.stu_id','ub.stu_id')
        ->where('ub.ub_id',$id)->paginate(5);

        return view('client.pages.union.list-member',compact('chihoi','thanhvien'));
    }









    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('union_posts')->where('up_id',$id)->delete();
        return  redirect()->back();
    }

}
