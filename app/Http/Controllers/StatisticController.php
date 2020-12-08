<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    private function getLike($semester_id,$school_year_id){
        $list=DB::table('likes as l')
        ->join('comments as cmt','cmt.com_id','l.com_id')
        ->join('posts as p','cmt.p_id','p.p_id')
        ->join('students as st','st.stu_id','cmt.stu_id')
        ->join('subjects as s','p.sub_id','s.sub_id')
        ->select( 
            'st.stu_code as MSSV',
            'st.stu_name as HoTen',
            DB::raw('count(l.l_status) as TongLuotLike')
            )
        ->where('s.semester_id',$semester_id)
        ->where('s.school_year_id',$school_year_id)
        ->where('l.l_status',1)
        ->groupBy('st.stu_id');
        
        return $list;

    }
    public function getAllLike(Request $request)
    {
        $list=$this->getLike($request->get('hocky'),$request->get('nienkhoa'));
        $list=$list
        ->get();
        return response()->json($list, 200);
    }
    public function getLikeSingleUser(Request $request)
    {
        $list=$this->getLike($request->get('hocky'),$request->get('nienkhoa'));
        $list=$list
        ->where('st.stu_code',$request->get('mssv'))
        ->get();
        return response()->json($list, 200);
    }
    public function choiceSemester()
    {
        $hocky = DB::table('semesters')->get();
        $nienkhoa = DB::table('school_years')->get();

        return view('client.pages.statistic.choiceSemester',compact(['hocky','nienkhoa']));
    }
}
