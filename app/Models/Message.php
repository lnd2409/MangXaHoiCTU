<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message', 'user_id'];
 
    public function student() {
        return $this->belongsTo('App\Models\Student');
    }

}