<?php

use Illuminate\Database\Seeder;

class sub_stu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for($i=8259;$i<=8290;$i++){
        //     for($j=1;$j<=3;$j++){
        //         DB::table('subjects_student')->insert([
        //             'stu_id'=>$i,
        //             'sub_id'=>rand(1,10)
        //         ]);
        //     }
        // }
        $count = 11;
        for ($i=8280; $i < 8290; $i++) {
            # code...
            $monHoc = $count++;
            // for ($j=11; $j < 20; $j++) {
            //     # code...
            //     $monHoc = $monHoc + $j;
            // }

            DB::table('subjects_student')
            ->insert(
                [
                    'stu_id'=>$i,
                    'sub_id' => $monHoc,
                    'sub_stu_trangthai' => 2
                ]
            );
        }
    }
}
