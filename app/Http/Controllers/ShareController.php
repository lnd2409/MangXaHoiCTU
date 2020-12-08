<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Student;
use App\Models\Comment;
use App\Notifications\InvoicePaid;
use DB;
use Carbon\Carbon;
class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function select()
    {
        $type=\DB::table('types')->get();
        $lastedPost = DB::table('items')->join('types','types.type_id','items.type_id')->where('item_status',1)->orderBy('item_created','DESC')->paginate(8);

        $post_viewed = session()->get('posts.post_club');
        // dd($post_viewed);
        if($post_viewed)
        {
            $baivietdaxem = DB::table('items')->whereIn('item_slug',$post_viewed)->get();
            // dd($baivietdaxem);
            return view('client.pages.share.select',compact('type','baivietdaxem','lastedPost'));
        }
        $baivietdaxem = 0;
        // $baiVietGanDay = DB::table('items')->orderBy('item_created','DESC')

        return view('client.pages.share.select',compact('type','baivietdaxem','lastedPost'));
    }
    public function index($slug)
    {

        $typeName = DB::table('types')->where('type_slug',$slug)->first();
        $share=Item::join('types as t','t.type_id','items.type_id')
        ->where('type_slug',$slug)->where('item_status',1)
        ->paginate(10);


        foreach($share as $item){

            $item->day=$this->getDay($item->item_id,$item->item_created);
        }

        $lastedPost = DB::table('items')->orderBy('item_created','DESC')->where('item_status',1)->paginate(5);

        $post_viewed = session()->get('posts.post_club');
        // dd($post_viewed);
        // dd($share);
        if($post_viewed)
        {
            $baivietdaxem = DB::table('items')->whereIn('item_slug',$post_viewed)->get();
            // dd($baivietdaxem);
            return view('client.pages.share.index',compact('share','baivietdaxem','lastedPost','typeName'));
        }
        $baivietdaxem = 0;
        return view('client.pages.share.index',compact('share','baivietdaxem','lastedPost','typeName'));
    }

    public function search(Request $request)
    {
        $share=\DB::table('items')->where('item_name',"LIKE",'%'.$request->content.'%')->get();
        if($share->isNotEmpty()){
            foreach($share as $item){

            $item->day=$this->getDay($item->item_id,$item->item_created);
            }
        }
        return response()->json($share, 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type=DB::table('types')->get();
        return view('client.pages.share.create',compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id=\DB::table('items')->max('item_id');
        $title=$this->sanitize($request->title);
        $slug=$title.'.'.$request->type.'&'.($id+1);
        if ($request->hasFile('avatar')) {
            //lưu file
            $file=$request->file('avatar')->getClientOriginalName();
            $type_file = \File::extension($file);
            $name_file=$slug.'.'.$type_file;
            $request->file('avatar')->move(
                public_path('/img/items/'.$request->type.'/'), //nơi cần lưu
                $name_file);
            \DB::table('items')->insert([
                'stu_id'=>\Auth::id(),
                'type_id'=>$request->type,
                'item_title'=>$request->title,
                'item_avatar'=>'img/items/'.$request->type.'/'.$name_file,
                'item_slug'=>$slug,//kết hợp id môn và id bài viết
                'item_price'=>$request->price,
                'item_phone'=>$request->phone,
                'item_name'=>$request->name,
                'item_content'=>$request->content,
                'item_status' => 0
            ]);
        }

        return redirect()->route('share')->with('success','Đã thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $reason=$this->getReasons();
        $post=DB::table('items as p')
        ->join('students as s','s.stu_id','p.stu_id')
        ->join('types','types.type_id','p.type_id')
        ->where('item_slug',$slug)
        ->first();
        $day='';
        session()->push('posts.post_club', $slug);
        $lastedPost = DB::table('items')->orderBy('item_created','DESC')->paginate(5);
        if($post){
            $day=$this->getDay($post->item_id,$post->item_created);
        }
        // đếm lượt xem
        app(\App\Http\Controllers\CountViewController::class)->check(false,false,false,$post->item_id);
        $comment = DB::table('comments')
        ->join('students','students.stu_id','comments.stu_id')
        ->OrderBy('com_id','DESC')->get();
        $post_viewed = session()->get('posts.post_club');
        // dd($post_viewed);
        // dd($share);
        if($post_viewed)
        {
            $baivietdaxem = DB::table('items')->whereIn('item_slug',$post_viewed)->get();
            // dd($baivietdaxem);
            return view('client.pages.share.single',compact('post','day','reason','comment','lastedPost','baivietdaxem','post_viewed'));
        }
        $baivietdaxem = 0;
        return view('client.pages.share.single',compact('post','day','reason','comment','lastedPost','baivietdaxem','post_viewed'));
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

    //Bình luận nè
    public function comment(Request $request)
    {
        $date = Carbon::now();
        $comment['com_content']= $request->com_content;
        $comment['com_created']= $date;
        $comment['stu_id']= $request->st_id;
        $comment['item_id']= $request->item_id;

        // dd($comment);


        $result = DB::table('comments')->insert($comment);
        if($result)
        {
           return redirect()->back();
        }
    }

    public function repcomment(Request $request)
    {
        $date = Carbon::now();
        $comment['com_content']= $request->com_repcontent;
        $comment['com_created']= $date;
        $comment['stu_id']= $request->st_id;
        $comment['item_id']= $request->item_id;
        $comment['com_idrep']=$request->com_id;

        $result = DB::table('comments')->insert($comment);
        if($result)
        {
           return redirect()->back();
        }
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
       $item = Item::find($id);
       $item->delete();
       return redirect()->route('share');


    }

    // xóa bình luận
    public function destroycomment(Request $request)
    {
       $item = Comment::find($request->com_id);
       $item->delete();
       return redirect()->back();


    }
    public function list($slug)
    {
        $share=Item::join('types as t','t.type_id','items.type_id')
        ->where('type_slug',$slug)
        ->paginate(10);
        $now=$this->now();
        $day[]='';


        foreach($share as $item){

            if($this->diffInDays($item->item_created)){

                $day[$item->item_id]=Carbon::parse($item->item_created)->diffForHumans($now);
            }
            else{
                $day[$item->item_id]=$this->format_date($item->item_created);
            }
        }
        $post_viewed = session()->get('posts.post_club');
        if($post_viewed)
        {
            $baivietdaxem = DB::table('items')->whereIn('item_slug',$post_viewed)->get();
            // dd($baivietdaxem);
            return view('client.pages.share.index',compact('share','day','baivietdaxem'));
        }
        $baivietdaxem = 0;
        return view('client.pages.share.index',compact('share','day','baivietdaxem'));
    }
}
