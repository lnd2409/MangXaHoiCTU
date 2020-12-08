<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messsage extends Model
{
    protected $fillable = ['mess_content', 'stu_id'];

    public function user() {
        return $this->belongsTo('App\Model\Student');
    }
}
