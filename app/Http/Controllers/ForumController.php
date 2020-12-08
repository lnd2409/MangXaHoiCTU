<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Post;
use Carbon\Carbon;
use App\Http\Controllers\CountViewController;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stu = DB::table('posts')
        ->join('subjects as sub','sub.sub_id','posts.sub_id')
        ->join('students','students.stu_id','posts.stu_id')->get();

        // dd($stu);
        //get subject of user
        $subject=\App::call('App\Http\Controllers\QuestionController@getSubjectsStudent');
        // dd($subject);
        //lấy lý do report

        $blog=Post::query();

        foreach($subject as $item){
            // dd($item->sub_id);
            $blog=$blog->orwhere('sub_id',$item->sub_id);
        }
        $blog=$blog->orderBy('p_id','DESC')->paginate(5);
        $now=$this->now();
        if($blog->isNotEmpty()){
            foreach($blog as $item){
                $item->day=$this->getDay($item->p_id,$item->p_created);
                $item->likes=\DB::table('posts as p')
                ->join('comments as c','c.com_id','p.p_id')
                ->where('p.p_id',$item->p_id)
                ->count();
                $item->comments=count($item->comments);
            }
        }

        // dd($blog);
        //GET
        $idStudent = Auth::guard('student')->id();
        #hoc phan dang hoc
        $getSubjectStudy = DB::table('subjects_student')->where('stu_id',$idStudent)->where('sub_stu_trangthai',1)->get();
        // dd($getSubjectStudy->pluck('sub_id'));
        $getSubPopular = DB::table('subjects_student')
                        ->join('subjects','subjects.sub_id','subjects_student.sub_id')
                        ->whereIn('subjects.sub_id',$getSubjectStudy->pluck('sub_id'))
                        ->where('subjects_student.stu_id',$idStudent)
                        ->get();

        $post_viewed = session()->get('posts.post_viewed');
        if($post_viewed)
        {
            $baivietdaxem = DB::table('posts')->whereIn('p_slug',$post_viewed)
            ->join('students','students.stu_id','posts.stu_id')
            ->get();
            // $stu = DB::table('posts')->join('students','students.stu_id','posts.stu_id')->get();

            // dd($baivietdaxem);
            return view('client.pages.forum.forum',compact('subject','blog','getSubPopular','baivietdaxem','stu'));
        }
        // $stu = DB::table('posts')->join('students','students.stu_id','posts.stu_id')->get();


        $baivietdaxem = 0;
        // dd($stu);
        return view('client.pages.forum.forum',compact('subject','blog','getSubPopular', 'baivietdaxem','stu'));
    }

    public function search(Request $request)
    {
        $blog=DB::table('posts')->where('p_title',"LIKE",'%'.$request->content.'%')->get();
        if($blog->isNotEmpty()){
            $now=$this->now();
                foreach($blog as $item){
                    $item->day=$this->getDay($item->p_id,$item->p_created);
                    $item->likes=\DB::table('posts as p')->join('comments as c','c.p_id','p.p_id')
                    ->join('likes as l','l.com_id','c.com_id')
                    ->where('p.p_id',$item->p_id)->count();
                    $item->comments=\DB::table('posts as p')->join('comments as c','c.p_id','p.p_id')
                    ->where('p.p_id',$item->p_id)->count();
                }
            }
        return response()->json($blog, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$slug)
    {
        //lấy lý do report
        $reason=$this->getReasons();
        $post=Post::join('students as s','s.stu_id','posts.stu_id')
        ->where('p_slug',$slug)
        ->first();
        session()->push('posts.post_viewed', $slug);
        $now=$this->now();
        $day='';
        if($post){

            $day=$this->getDay($post->p_id,$post->p_created);
        }
        $comment = DB::table('comments')
        ->join('students','students.stu_id','comments.stu_id')
        ->OrderBy('com_id','DESC')->get();
        $myself=array();
        $count_like=array();
        // dd($comment);
        $like=0;
        if($comment->isNotEmpty()){

            foreach($comment as $item){
                $like = DB::table('likes as l')
                ->where('l.com_id',$item->com_id)
                ->where('l_status',1);
                $count_like[$item->com_id]=count($like->get());

                $like =$like->where('l.stu_id',\Auth::id())
                ->first();
                if($like){
                    $myself[$item->com_id]=1;
                }
                else{

                    $myself[$item->com_id]=0;
                }

            }
        }

        // đếm lượt xem
        app(\App\Http\Controllers\CountViewController::class)->check($post->p_id,false,false,false);
        return view('client.pages.forum.single',compact(['post','day','comment','like','myself','count_like','reason']));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
