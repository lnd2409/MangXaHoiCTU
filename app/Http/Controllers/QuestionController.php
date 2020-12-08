<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Notifications\InvoicePaid;
use App\Notifications\Noti;
use DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getSubjectsStudent()
    {
        // get id of user
        $id=\Auth::id();
        // get subject to select
        $subject=\DB::table('subjects_student as ss')->join('students as s','ss.stu_id','s.stu_id')
        ->join('subjects as su','su.sub_id','ss.sub_id')
        ->where('s.stu_id',$id)
        ->where('sub_stu_trangthai',1)
        ->orderBy('sub_stu_trangthai','ASC')
        ->get('su.*');
        // dd($subject);
        return $subject;
    }
    public function create()
    {
        $subject=$this->getSubjectsStudent();
        return view('client.pages.forum.question',compact('subject'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //lấy id bài viết cuối
        $id=\DB::table('posts')->max('p_id');
        $title=$this->sanitize($request->title);
        \DB::table('posts')->insert([
            'stu_id'=>\Auth::id(),
            'sub_id'=>$request->subject,
            'p_slug'=>$title.'.'.$request->subject.'&'.($id+1),//kết hợp id môn và id bài viết
            'p_title'=>$request->title,
            'p_content'=>$request->content,
        ]);
        $user = Student::find(2); // id của user mình đã đăng kí ở trên, user này sẻ nhận được thông báo
        $data = [
            'Thử ',
            'thông báo',
        ];
        // \Notification::send($user, new Noti($data));
        // $user->notify(new InvoicePaid($data));
        return redirect()->route('forum');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('posts')->where('p_id',$id)->delete();
        return  redirect()->back();
    }
}
