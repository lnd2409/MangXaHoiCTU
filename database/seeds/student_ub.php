<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class student_ub extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // chỉ chay theo dung tung step
        // $a=['LCHT','LCHP','UV','HV'];
        // step 1
        // for($i=2;$i<=8256;$i++){
        //     $lucky=rand(0,1);
        //     if($lucky==1){

        //     DB::table('students_ub')->insert([
        //         'stu_id'=>$i,
        //         'ub_id'=>rand(1,122),
        //         'sub_role'=>'HV',
        //         'sub_status'=>'Duyet'
        //         ]);
        //     }
        // }
        // step 2

        // for($j=1;$j<=13;$j++){
        //     $temp=DB::table('students_ub')
        //     ->inRandomOrder()
        //     ->wherein('sub_role',['UV','LCHP','LCHT'])
        //     ->limit(1)->get();
        //     // ->where('ub_id',$j)
        //     // ->first();
        //     foreach($temp as $item){

        //         DB::table('students_uo')
        //         ->insert([
        //                 'stu_id'=>$item->stu_id,
        //                 'uo_id'=>$j,
        //                 'suo_role'=>'LCHT',
        //                 'suo_status'=>'Duyet'
        //             ]);
        //         }

        //     }
            // $start = 8259;
            // $start = 8264;
            // $start = 8269;
            // $start = 8274;
            // $start = 8278;
            $start = 8283;
            $end = $start + 5;
            for ($i=8288; $i < 8290; $i++) {
                # code...
                DB::table('students_ub')->insert(
                    [
                        'sub_status' => 'Duyet',
                        'sub_role' => 'HV',
                        'sub_created' => Carbon::now(),
                        'stu_id' => $i,
                        'ub_id' => 87
                    ]
                );
            }


    }
}
