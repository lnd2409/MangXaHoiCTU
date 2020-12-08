<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNotificationClub implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $c_id;
    private $stu_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($c_id,$stu_id)
    {
        $this->c_id = $c_id;
        $this->stu_id = $stu_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $club=\DB::table('clubs')->where('c_id',$this->c_id)->first();
        $stu=\DB::table('students')->where('stu_id',$this->stu_id)->first();
        $list=\DB::table('club_students')->where('c_id',$this->c_id)->get('stu_id');
        foreach($list as $item){

            \DB::table('notifications')->insert([
                'noti_content'=>'<b>'.$stu->stu_name.'</b> đã đăng trong <b>'.$club->c_name.'</b>',
                'stu_id'=>$item->stu_id
            ]);
        }
    }
}
