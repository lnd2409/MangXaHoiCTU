<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class AccountController extends Controller
{

    // tìm thông tin của sv qua slug
    public function getInfo($slug)
    {
        $code = Str::before($slug, '.');
        $name = Str::after($slug, '.');
        $find = \DB::table('students')->where('stu_code', $code)->first('stu_name');
        if ($find) {

            if (Str::slug($find->stu_name, '-') == $name) {
                $student = \DB::table('students')
                    //thông tin học
                    ->join('youth_branchs as yb', 'yb.yb_id', 'students.yb_id')
                    ->join('courses', 'courses.course_id', 'yb.course_id')
                    ->join('majors', 'majors.major_id', 'yb.major_id')
                    ->join('academies', 'academies.academy_id', 'majors.academy_id')
                    // chi hội
                    ->leftjoin('students_ub as sub', 'sub.stu_id', 'students.stu_id')
                    ->leftjoin('union_branchs as ub', 'sub.ub_id', 'ub.ub_id')
                    ->where('stu_code', $code)
                    ->first();
                $student->stu_birth = $this->format_date($student->stu_birth);
                $student->sub_created = $this->format_date($student->sub_created);
                // dd($student);
                return $student;
            }
        }
        return false;
    }
    // tìm id sv qua mssv
    private function findStu($mssv)
    {
        $stu = \DB::table('students')->where('stu_code', $mssv)->first('stu_id');
        if ($stu) {
            return $stu;
        } else {
            return false;
        }
    }
    public function SemesterYear()
    {
        $hocky = \DB::table('semesters')->max('semester_id');
        $nienkhoa = \DB::table('school_years')->max('school_year_id');
        $data = ['hocky' => $hocky, 'nienkhoa' => $nienkhoa];

        return $data;
    }
    // tương tác trong học kỳ
    public function Interactive($stu_id, $semester_id, $school_year_id)
    {
        // bài đã post
        $Post = \DB::table('posts')
            ->join('subjects', 'subjects.sub_id', 'posts.sub_id')
            ->where('semester_id', $semester_id)
            ->where('school_year_id', $school_year_id)
            ->where('stu_id', $stu_id)->count();
        // dd($Posts);

        //ds số lượt đã like
        $Like = DB::table('likes as l')
            ->join('comments as cmt', 'cmt.com_id', 'l.com_id')
            ->join('posts as p', 'cmt.p_id', 'p.p_id')
            ->join('subjects', 'subjects.sub_id', 'p.sub_id')
            ->where('semester_id', $semester_id)
            ->where('school_year_id', $school_year_id)
            ->where('l.l_status', 1)
            ->where('l.stu_id', $stu_id)
            ->count();
        // dd($Like);
        //ds số lượt được like
        $Liked = DB::table('likes as l')
            ->join('comments as cmt', 'cmt.com_id', 'l.com_id')
            ->join('posts as p', 'cmt.p_id', 'p.p_id')
            ->join('subjects', 'subjects.sub_id', 'p.sub_id')
            ->where('semester_id', $semester_id)
            ->where('school_year_id', $school_year_id)
            ->where('l.l_status', 1)
            ->where('cmt.stu_id', $stu_id)
            ->count();
        // dd($Liked);
        //ds số lượt đã comment
        $Comment = \DB::table('comments')
            ->join('posts', 'posts.p_id', 'comments.p_id')
            ->join('subjects', 'subjects.sub_id', 'posts.sub_id')
            ->where('semester_id', $semester_id)
            ->where('school_year_id', $school_year_id)
            ->where('comments.stu_id', $stu_id)->count();
        // dd($Comment);
        //ds số lượt nhận report
        $Reported = \DB::table('reports')
            ->join('comments', 'comments.com_id', 'reports.com_id')
            ->join('posts', 'posts.p_id', 'comments.p_id')
            ->join('subjects', 'subjects.sub_id', 'posts.sub_id')
            ->where('semester_id', $semester_id)
            ->where('school_year_id', $school_year_id)
            ->where('comments.stu_id', $stu_id)->count();
        // dd($Reported);
        //ds số lượt report người khác
        $Report = \DB::table('reports')
            ->join('comments', 'comments.com_id', 'reports.com_id')
            ->join('posts', 'posts.p_id', 'comments.p_id')
            ->join('subjects', 'subjects.sub_id', 'posts.sub_id')
            ->where('semester_id', $semester_id)
            ->where('school_year_id', $school_year_id)
            ->where('reports.stu_id', $stu_id)->count();
        // dd($Report);
        return $data = [
            'Post' => $Post,
            'Like' => $Like,
            'Liked' => $Liked,
            'Comment' => $Comment,
            'Report' => $Report,
            'Reported' => $Reported,
        ];
    }


    //ds các câu lạc bộ đã tham gia
    public function JoinedClub($stu_id)
    {

        $data = \DB::table('club_students')
            ->join('clubs', 'clubs.c_id', 'club_students.c_id')
            ->where('club_students.stu_id', $stu_id)->get();
        if ($data->isNotEmpty()) {

            foreach ($data as $item) {
                $item->cs_created = $this->format_date($item->cs_created);
                $item->view = 0;
                $item->posTotal = 0;

                $item->perContribute = 0;
                $view = DB::table('count_view_clubs')
                    ->join('club_posts', 'club_posts.cp_id', 'count_view_clubs.cp_id')
                    ->where('count_view_clubs.stu_id', $item->stu_id)
                    ->where('club_posts.c_id', $item->c_id)
                    ->get('club_posts.cp_id');
                $posTotal = DB::table('club_posts')
                    ->whereDate('cp_created', '>=', $item->cs_created)
                    ->where('c_id', $item->c_id)
                    ->get('club_posts.cp_id');
                if ($view->isNotEmpty()) {

                    $item->view = count($view);
                }
                if ($posTotal->isNotEmpty()) {

                    $item->posTotal = count($posTotal);
                }
                if ($view->isNotEmpty() && $posTotal->isNotEmpty()) {


                    $item->perContribute = round($item->view * 100 / $item->posTotal, 2);
                }
            }
        }

        return $data;
    }
    //ds các bài đã đăng trong mục chia sẻ
    public function ShareItem($stu_id)
    {
        $data = \DB::table('items')
            ->join('types', 'types.type_id', 'items.type_id')
            ->where('items.stu_id', $stu_id)->get();
        foreach ($data as $item) {
            $item->item_created = $this->format_date($item->item_created);
            $thanks = DB::table('item_likes')->where('item_id', $item->item_id)->count();
            $dislike = DB::table('item_reports')->where('item_id', $item->item_id)->count();
            $view = DB::table('count_view_items')->where('item_id', $item->item_id)->count();
            $item->thanks = $thanks;
            $item->dislike = $dislike;
            $item->view = $view;
        }


        return $data;
    }
    // đếm bài đã đăng trong forum
    public function PostForum($stu_id)
    {


        $data = \DB::table('posts')
            ->join('subjects', 'subjects.sub_id', 'posts.sub_id')
            ->join('semesters', 'subjects.semester_id', 'semesters.semester_id')
            ->join('school_years', 'school_years.school_year_id', 'subjects.school_year_id')
            ->where('stu_id', $stu_id)
            ->orderby('school_years.school_year_id')
            ->orderby('school_years.school_year_id')
            ->groupby('subjects.sub_id')
            ->get();
        foreach ($data as $item) {
            $post = DB::table('posts')->where('sub_id', $item->sub_id)
                ->where('stu_id', $stu_id)->count();
            $comment = DB::table('comments')
                ->join('posts', 'posts.p_id', 'comments.p_id')
                ->where('comments.p_id', $item->p_id)->count();
            $view = DB::table('count_view_posts')
                ->join('posts', 'posts.p_id', 'count_view_posts.p_id')
                ->where('posts.p_id', $item->p_id)->count();
            $item->post = $post;
            $item->comment = $comment;
            $item->view = $view;
        }

        return $data;
    }
    public function getLikeSingleUser($semester, $school_years, $info)
    {
        $list = DB::table('likes as l')
            ->join('comments as cmt', 'cmt.com_id', 'l.com_id')
            ->join('posts as p', 'cmt.p_id', 'p.p_id')
            ->join('students as st', 'st.stu_id', 'cmt.stu_id')
            ->join('subjects as s', 'p.sub_id', 's.sub_id')
            ->select(
                'st.stu_code as MSSV',
                'st.stu_name as HoTen',
                DB::raw('count(l.l_status) as TongLuotLike')
            )
            ->where('s.semester_id', $semester)
            ->where('s.school_year_id', $school_years)
            ->where('l.l_status', 1)
            ->where('st.stu_code', $info)
            ->groupBy('st.stu_id')
            ->get();
        return $list;
    }
    public function Info(Request $request, $slug)
    {
        $semester = $this->SemesterYear()['hocky'];
        $school_years = $this->SemesterYear()['nienkhoa'];
        // lấy thông tin cá nhân
        $info = $this->getInfo($slug);
        if ($info) {

            //câu lạc bộ đã tham gia
            $JoinedClub = $this->JoinedClub($info->stu_id);
            // vật dụng đã chia sẻ
            $ShareItem = $this->ShareItem($info->stu_id);
            // bài đã đăng
            $PostForum = $this->PostForum($info->stu_id);

            $Data = $this->Interactive($info->stu_id, $semester, $school_years);

            return view('client.pages.account.index', ['student' => $info], compact(
                'Data',
                'JoinedClub',
                'ShareItem',
                'PostForum'
            ));
        } else {
            return back();
        }
    }

    public function studied()
    {
        $data = DB::table('subjects_student as st')
            ->join('subjects as s', 's.sub_id', 'st.sub_id')
            ->join('semesters as se', 'se.semester_id', 's.semester_id')
            ->join('school_years as sy', 'sy.school_year_id', 's.school_year_id')
            ->where('st.stu_id', \Auth::id())
            ->get();
        // dd($data);
        return view('client.pages.account.studied', compact('data'));
    }
}
