<?php

namespace App\Http\Controllers\QuanTri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Str;
use App\Models\Item;
class ShareItemController extends Controller
{
    public function getItems()
    {
        $typeItems = DB::table('types')->get();
        $items = DB::table('items')->where('item_status',0)->get()->count();
        return view('client.pages.share.manage.index', compact('typeItems','items'));
    }

    public function getItemsNotAcp()
    {
        $items = DB::table('items')->where('item_status',0)->get();
        // dd($items;
        return view('client.pages.share.manage.item-not-acp', compact('items'));
    }

    public function actionItem($action, $idItem)
    {
        switch ($action) {
            case 'accept':
                # code...
                DB::table('items')->where('item_id',$idItem)->update(['item_status' => 1]);
                break;
            case 'detail':
                # code...
                DB::table('items')->where('item_id',$idItem)->update(['item_status' => 1]);
                $reason=$this->getReasons();
                $post=DB::table('items as p')
                ->join('students as s','s.stu_id','p.stu_id')
                ->join('types','types.type_id','p.type_id')
                ->where('item_id',$idItem)
                ->first();
                $day='';
                $lastedPost = DB::table('items')->orderBy('item_created','DESC')->paginate(5);
                if($post){
                    $day=$this->getDay($post->item_id,$post->item_created);
                }

                return view('client.pages.share.manage.detail',compact('post','day','reason'));
                break;
            case 'delete':
                # code...
                DB::table('items')->where('item_id',$idItem)->delete();
                break;
        }
        return redirect()->back();
    }

    public function getAllItems()
    {
        // $typeName = DB::table('types')->where('type_slug',$slug)->first();
        $share=Item::join('types as t','t.type_id','items.type_id')
        ->where('item_status',1)
        ->orderBy('item_id','DESC')
        ->paginate(10);

        foreach($share as $item){

            $item->day=$this->getDay($item->item_id,$item->item_created);
        }
        // dd($share);
        return view('client.pages.share.manage.list-item', compact('share'));
    }

    public  function ItemStore(Request $request)
    {

        if ($request->hasFile('type_hinh')) {
            //lưu filed
            $file=$request->file('type_hinh')->getClientOriginalName();

            $request->file('type_hinh')->move(
                public_path('svg/'), //nơi cần lưu
                $file);
            $data['type_image']='svg/'.$file;
        }
        $data['type_name']=$request->type_name;
        $data['type_slug']= Str::slug($request->type_name);


    DB::table('types')->insert($data);
    return  redirect()->back();

    }
    public  function itemUpdate(Request $request)
    {

        if ($request->hasFile('type_hinh')) {
            //lưu filed
            $file=$request->file('type_hinh')->getClientOriginalName();

            $request->file('type_hinh')->move(
                public_path('svg/'), //nơi cần lưu
                $file);
            $data['type_image']='svg/'.$file;
        }
        $data['type_name']=$request->type_name;
        $data['type_slug']= Str::slug($request->type_name);
        $data['type_id']= $request->type_id;

        // dd($data);


        DB::table('types')->where('type_id',$data['type_id'])->update($data);
        return  redirect()->back();

    }

    public function getAjax(Request $request){

       if($request->ajax())
        {
            $data = DB::table('types')->where('type_id',$request->id)->first();
            return response()->json($data,200);
        }

    }
    public function itemDelete($id){

        $data = DB::table('types')->where('type_id',$id)->delete();
       return redirect()->back();
    }


    #bài viết chưa duyệt
}
