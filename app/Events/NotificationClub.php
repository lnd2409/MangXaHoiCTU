<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationClub implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $c_id;
    private $stu_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($c_id,$stu_id)
    {
        
        $this->c_id = $c_id;
        $this->stu_id = $stu_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
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
        \DB::table('notifications')->insert([
            'noti_content'=>'<b>'.$stu->stu_name.'</b> đã đăng trong <b>'.$club->c_name.'</b>',
            'stu_id'=>2
        ]);
        return new PrivateChannel('notification_club');
    }
}
