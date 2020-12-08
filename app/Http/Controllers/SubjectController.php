<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($subCode)
    {
        $subject = DB::table('subjects')
                        ->where('sub_code',$subCode)
                        ->join('semesters','semesters.semester_id','subjects.semester_id')
                        ->join('school_years','school_years.school_year_id','subjects.school_year_id')
                        ->first();
        $postSubject = DB::table('posts')
                        ->join('subjects','subjects.sub_id','posts.sub_id')
                        ->join('students','students.stu_id','posts.stu_id')
                        ->where('sub_code',$subCode)->get();
        $day[]='';
        if($postSubject->isNotEmpty()){
            foreach($postSubject as $item){
                $day[$item->p_id]=$this->getDay($item->p_id,$item->p_created);
            }
        }
        $post_viewed = session()->get('posts.post_viewed');
        if($post_viewed)
        {
            $baivietdaxem = DB::table('posts')->whereIn('p_slug',$post_viewed)
                                ->join('students','students.stu_id','posts.stu_id')
                                ->join('subjects','subjects.sub_id','posts.sub_id')
                                ->where('sub_code',$subCode)
                                ->get();
            // dd($baivietdaxem);
            return view('client.pages.subject.index', compact('postSubject','subject','day','baivietdaxem'));
        }
        // dd($postSubject);
        return view('client.pages.subject.index', compact('postSubject','subject','day'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
    }
}
