<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportComment(Request $request)
    {
        try {
            //code...

        $find=\DB::table('reports')->where('stu_id',\Auth::id())->where('com_id',$request->id)->first();
        if(!$find){

            $reports_id=\DB::table('reports')->insertGetId([
                'com_id'=>$request->id,
                'stu_id'=>\Auth::id(),
                ]);
            foreach($request->reason as $item){
                \DB::table('reasons_report')->insert([
                    'reason_id'=>$item,
                    'r_id'=>$reports_id,
                ]);

            }
        }
       return response()->json('success', 200);
    } catch (\Throwable $th) {
        return response()->json('error', 200);
        //throw $th;
    }

    }
    public function reportItem(Request $request)
    {
        try{

            $find=\DB::table('item_reports')->where('stu_id',\Auth::id())->where('item_id',$request->id)->first();
            if(!$find){

                $reports_id=\DB::table('item_reports')->insertGetId([
                    'item_id'=>$request->id,
                    'stu_id'=>\Auth::id(),
                    ]);
                foreach($request->reason as $item){
                    \DB::table('ir_reasons')->insert([
                        'reason_id'=>$item,
                        'ir_id'=>$reports_id
                    ]);

                }
            }
            return response()->json('success', 200);
        }
        catch(\Throwable $th){
            return response()->json('error', 200);
        }


    }
}
