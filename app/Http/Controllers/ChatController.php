<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Events\ChatMessage;
use DB;
use Auth;
class ChatController extends Controller
{
    public function chatRoom(){
        $idStudent = Auth::guard('student')->id();
        $student= DB::table('students')->where('stu_id', $idStudent)->first();
        $studentInClass = DB::table('youth_branchs')->where('yb_id',$student->yb_id)
                        ->join('courses','courses.course_id','youth_branchs.course_id')
                        ->join('majors','majors.major_id','youth_branchs.major_id')
                        ->first();
        $listStudent = DB::table('students')->where('yb_id',$studentInClass->yb_id)->get();
        // dd($listStudent);
        return view('client.pages.chat.index', compact('listStudent','studentInClass','student'));
    }

    public function chatPerson($mssv)
    {
        $sinhVien = DB::table('students')->where('username',$mssv)->first();
        return view('client.pages.chat-detail.index', compact('sinhVien'));
    }

    public function chat($mssv)
    {
        $sinhVien = DB::table('students')->where('username',$mssv)->first();
        return view('client.pages.chat-detail.index-2', compact('sinhVien'));
    }
}
