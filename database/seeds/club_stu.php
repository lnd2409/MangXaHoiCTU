<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class club_stu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 8259; $i <= 8290 ; $i++) {
            # code...
            DB::table('club_students')->insert(
                [
                    'cs_role' => 'TV',
                    'cs_created' => Carbon::now(),
                    'stu_id' => $i,
                    'c_id' => rand(1,10)
                ]
            );
        }
    }
}
