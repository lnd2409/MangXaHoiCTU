<?php

use Illuminate\Database\Seeder;

class classes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course=[1,2,3,4];
        $major=DB::table('majors')->get();
        // tạo theo ngành
        foreach($major as $item){
            $code=str_random(2);
            // tạo theo khóa
            foreach($course as $value){

                // tạo theo lớp
                $j=rand(1,2);
                for($i=1;$i<=$j;$i++){

                    DB::table('youth_branchs')->insert([
                        'major_id'=>$item->major_id,
                        'course_id'=>$value,
                        'yb_name'=>$code.'1'.($value+5).'95A'.$i
                    ]);
                }
            }
        }
    }
}
