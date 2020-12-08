<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use File;
use Carbon\Carbon;
class DocumentShareController extends Controller
{

    public function findDocument(Request $request)
    {
        $tenMonHoc = $request->tenMonHoc;
        $result = DB::table('folders')
                    ->join('subjects','subjects.sub_id','folders.sub_id')
                    ->join('students','students.stu_id','folders.stu_id')
                    ->join('semesters','semesters.semester_id','subjects.semester_id')
                    ->join('school_years','school_years.school_year_id','subjects.school_year_id')
                    ->where('folders.stu_id','<>',Auth::guard('student')->id())
                    ->where('fo_child',NULL)
                    ->where('subjects.sub_name','like','%'.$tenMonHoc.'%')
                    ->where('fo_permission','access')
                    ->get();
        // dd($result);
        return view('client.pages.docs-share.folder-find',compact('tenMonHoc','result'));
    }






    public function getDocument($codeStudent)
    {
        // $docStu = DB::table('')
        $idStudent = DB::table('students')->where('stu_code',$codeStudent)->first();
        $sub_studied_id = DB::table('folders')->where('stu_id','=',$idStudent->stu_id)->get()->pluck('sub_id')->toArray();
        $sub_studied = DB::table('folders')->where('stu_id','=',$idStudent->stu_id)->where('fo_child','=',null)->whereIn('sub_id',$sub_studied_id)->get();

        $hocky = DB::table('semesters')->get();
        $nienkhoa = DB::table('school_years')->get();

        //Lấy thư mục đã tạo ở đây
        $sub_studied_id = DB::table('folders')->where('stu_id','=',$idStudent->stu_id)->get()->pluck('sub_id')->toArray();
        $sub_studied = DB::table('folders')->where('stu_id','=',$idStudent->stu_id)->where('fo_child','=',null)->where('fo_permission','access')->whereIn('sub_id',$sub_studied_id)->get();
        $hkSelected = DB::table('semesters')->where('semester_id','=',1)->first();
        $nkSelected = DB::table('school_years')->where('school_year_id','=',1)->first();


        // Lấy tất cả học phần người đó học trong năm học nào đó !
        $subject_student = DB::table('subjects_student')
                            // ->join('students','students.stu_id','subjects_student.stu_id')
                            ->join('subjects','subjects.sub_id','subjects_student.sub_id')
                            ->join('semesters','semesters.semester_id','subjects.semester_id')
                            ->join('school_years','school_years.school_year_id','subjects.school_year_id')
                            ->join('students','students.stu_id','subjects_student.stu_id')
                            ->where('subjects.semester_id','=',1)
                            ->where('subjects.school_year_id','=',1)
                            ->where('subjects_student.stu_id','=',$idStudent->stu_id)
                            ->whereNotIn('subjects.sub_id',$sub_studied_id)
                            ->get();

        // dd($subject_student);

        return view('client.pages.docs-share.index-2',compact(['subject_student','hocky','nienkhoa','nkSelected','hkSelected','sub_studied','idStudent']));
    }
    //Chọn niên khóa và học kỳ
    public function getHocKy()
    {
        $hocky = DB::table('semesters')->get();
        $nienkhoa = DB::table('school_years')->get();

        return view('client.pages.docs-share.chon-nien-khoa',compact(['hocky','nienkhoa']));
    }

    //Trang hiển thị các môn học
    public function index(Request $request)
    {
        $idStudent = Auth::guard('student')->id();
        $hocky = DB::table('semesters')->get();
        $nienkhoa = DB::table('school_years')->get();

        //Lấy thư mục đã tạo ở đây
        $sub_studied_id = DB::table('folders')->where('stu_id','=',$idStudent)->get()->pluck('sub_id')->toArray();
        $sub_studied = DB::table('folders')->where('stu_id','=',$idStudent)->where('fo_child','=',null)->whereIn('sub_id',$sub_studied_id)->get();
        // dd($sub_studied);

        // Lấy ra học kỳ niên khóa đã chọn
        $rqnienkhoa = $request->get('nienkhoa');
        $rqhocky = $request->get('hocky');
        $hkSelected = DB::table('semesters')->where('semester_id','=',$rqhocky)->first();
        $nkSelected = DB::table('school_years')->where('school_year_id','=',$rqnienkhoa)->first();


        // Lấy tất cả học phần người đó học trong năm học nào đó !
        $subject_student = DB::table('subjects_student')
                            // ->join('students','students.stu_id','subjects_student.stu_id')
                            ->join('subjects','subjects.sub_id','subjects_student.sub_id')
                            ->join('semesters','semesters.semester_id','subjects.semester_id')
                            ->join('school_years','school_years.school_year_id','subjects.school_year_id')
                            ->where('subjects.semester_id','=',$rqhocky)
                            ->where('subjects.school_year_id','=',$rqnienkhoa)
                            ->where('stu_id','=',$idStudent)
                            ->whereNotIn('subjects.sub_id',$sub_studied_id)
                            ->get();
        // dd($subject_student);

        return view('client.pages.docs-share.index',compact(['subject_student','hocky','nienkhoa','nkSelected','hkSelected','sub_studied']));
    }

    //Tạo thư mục môn học
    public function createNewFolderSubjects($ten_mon_hoc, $id_mon_hoc)
    {
        //Hàm mã hóa ký tự SEO
        function utf8convert($str) {

            if(!$str) return false;

            $utf8 = array(

            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'd'=>'đ|Đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',

            );

            foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);

            return $str;

        }
        function utf8tourl($text){
            $text = strtolower(utf8convert($text));
            $text = str_replace( "ß", "ss", $text);
            $text = str_replace( "%", "", $text);
            $text = preg_replace("/[^_a-zA-Z0-9 -] /", "",$text);
            $text = str_replace(array('%20', ' '), '-', $text);
            $text = str_replace("----","-",$text);
            $text = str_replace("---","-",$text);
            $text = str_replace("--","-",$text);
            return $text;
        }

        //Lấy id của students
        $idStudent = Auth::guard('student')->id();
        // try {
            //code...
            $subject_studying = DB::table('folders')->where('stu_id','=',$idStudent)->get();
            foreach ($subject_studying as $key => $value) {
                if ($value->sub_id == $id_mon_hoc) {
                    # code...
                    return response()->json("Thư mục đã tồn tại", 200);
                }
            }


            $randomSEO = rand(1000,9999);
            $foldersNews = DB::table('folders')->insert(
                    [
                        'fo_slug' => utf8tourl($ten_mon_hoc),
                        'fo_name' => $ten_mon_hoc,
                        'fo_directory' => 'tai-lieu-sinh-vien'.'/'.$idStudent.'/'.utf8tourl($ten_mon_hoc),
                        'fo_permission' => 'access',
                        'sub_id' => $id_mon_hoc,
                        'stu_id' => $idStudent
                    ]
                );
            $path = public_path().'/'.'tai-lieu-sinh-vien'.'/'.$idStudent.'/'.utf8tourl($ten_mon_hoc);
            File::makeDirectory($path, 0777, true);
            return redirect()->back();

        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return response()->json('Có lỗi trong quá trình tạo thư mục', 401);
        // }
    }

    //Chi tiết thư mục
    public function folderDetail( $nkSelected,$hkSelected,$nameFolders)
    {
        try {
            #code...
            // dd($nameFolders);
            $idStudent = Auth::guard('student')->id();
            $hkSelected1 = DB::table('semesters')->where('semester_id','=',$hkSelected)->first();
            $nkSelected1 = DB::table('school_years')->where('school_year_id','=',$nkSelected)->first();
            $folder = DB::table('folders')->where('stu_id','=',$idStudent)->where('fo_slug','=',$nameFolders)->first();
            $folder_detail = DB::table('folders')->where('fo_child','=',$folder->fo_id)->get();
            $folder_child = DB::table('folders')->where('fo_id','=',$folder->fo_child)->first();
            // dd($folder->fo_id);
            $files = DB::table('files')->where('fo_id','=',$folder->fo_id)->get();
            // dd($files);
            // dd($folder);
            return view('client.pages.docs-share.detail',compact(['folder','folder_detail','hkSelected','nkSelected','hkSelected1','nkSelected1','folder_child','files']));
        } catch (\Throwable $th) {
            //throw $th;
            dd("Có lỗi gì đó sửa đi");
        }
    }

    public function folderDetailForUser( $nkSelected,$hkSelected,$nameFolders,$idStudent)
    {
        try {
            #code...
            // dd($nameFolders);
            // $idStudent = Auth::guard('student')->id();
            $hkSelected1 = DB::table('semesters')->where('semester_id','=',$hkSelected)->first();
            $nkSelected1 = DB::table('school_years')->where('school_year_id','=',$nkSelected)->first();
            $folder = DB::table('folders')->join('students','students.stu_id','folders.stu_id')->where('fo_slug','=',$nameFolders)->where('folders.stu_id','=',$idStudent)->first();
            $folder_detail = DB::table('folders')->where('fo_child','=',$folder->fo_id)->get();
            $folder_child = DB::table('folders')->where('fo_id','=',$folder->fo_child)->first();
            $files = DB::table('files')->where('fo_id','=',$folder->fo_id)->get();
            // dd($folder);
            return view('client.pages.docs-share.detail',compact(['folder','folder_detail','hkSelected','nkSelected','hkSelected1','nkSelected1','folder_child','files']));
        } catch (\Throwable $th) {
            //throw $th;
            dd("Có lỗi gì đó sửa đi");
        }
    }


    //tạo thư mục con
    public function createNewFolderChild(Request $request)
    {
         //Hàm mã hóa ký tự SEO
         function utf8convert($str) {

            if(!$str) return false;

            $utf8 = array(

            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'd'=>'đ|Đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',

            );

            foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);

            return $str;

        }
        function utf8tourl($text){
            $text = strtolower(utf8convert($text));
            $text = str_replace( "ß", "ss", $text);
            $text = str_replace( "%", "", $text);
            $text = preg_replace("/[^_a-zA-Z0-9 -] /", "",$text);
            $text = str_replace(array('%20', ' '), '-', $text);
            $text = str_replace("----","-",$text);
            $text = str_replace("---","-",$text);
            $text = str_replace("--","-",$text);
            return $text;
        }

        $idStudent = Auth::guard('student')->id();
        $tenthumuc = $request->tenthumuc;
        $randomSEO = rand(1000,9999);
        try {
            //code...
            $abc = $request->duongdan.'/'.utf8tourl($tenthumuc);
            $folder_child = DB::table('folders')->where('fo_directory','=',$abc)->first();
            if($folder_child)
            {
                dd("Đã tồn tại thư mục này rồi");
            }
            else{
                $thumuccon = DB::table('folders')->insert(
                    [
                        'fo_name' => $tenthumuc,
                        'fo_slug' => utf8tourl($tenthumuc),
                        'fo_directory' => $request->duongdan.'/'.utf8tourl($tenthumuc),
                        'fo_permission' => 'access',
                        'sub_id' => $request->mamon,
                        'stu_id' => $idStudent,
                        'fo_child' => $request->mathumuchientai
                    ]
                );
                $path = public_path().'/'.$request->duongdan.'/'.utf8tourl($tenthumuc);
                File::makeDirectory($path, 0777, true);
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            //throw $th;
           return response()->json("ERROR", 401);
        }
    }


    //Upload file
    public function uploadDocuments(Request $request)
    {
        // dd('123');
        // dd($request->fo_id, $request->fo_dir);
        $time_now = Carbon::now();
        try {
            //code...
            if ($request->hasFile('file')) {
                # code...
                foreach ($request->file('file') as $file) {
                    # code...
                    $name = $file->getClientOriginalName();
                    $size = $file->getClientSize();
                    $file->move(public_path().'/'.$request->fo_dir, $name);
                    DB::table('files')->insert(
                        [
                            'f_name' => $name,
                            'f_size' => $size,
                            'f_path' => $request->fo_dir.'/'.$name,
                            'f_created' => $time_now,
                            'f_updated' => 'NULL',
                            'f_deleted' => 'NULL',
                            'fo_id' => $request->fo_id
                        ]
                    );
                }
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd("Có cái lỗi gì đó ở đây mà tôi không biết hihi !");
        }

    }

    public function changePermission($id){
        $idFolder = DB::table('folders')->where('fo_id',$id)->first();
        if($idFolder->fo_permission === "access"){
            DB::table('folders')->where('fo_id',$id)->update(['fo_permission' => 'denied']);
            return response()->json("Đã chuyển về trạng thái riêng tư", 200);
        }
        else {
            DB::table('folders')->where('fo_id',$id)->update(['fo_permission' => 'access']);
            return response()->json("Đã chuyển về trạng thái công khai", 200);
        }
    }

    public function deleteFolder($id){
        $idStudent = Auth::guard('student')->id();
        $idFolder = DB::table('folders')->where('fo_id',$id)->first();
        $path = public_path().'/'.'tai-lieu-sinh-vien'.'/'.$idStudent.'/'.$idFolder->fo_slug;
        File::deleteDirectory($path);
        $delFolder = DB::table('folders')->where('fo_id',$id)->delete();

        return response()->json("Đã xóa thư mục", 200);

    }
}
