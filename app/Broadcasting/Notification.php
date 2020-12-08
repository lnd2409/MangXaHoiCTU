<?php

namespace App\Broadcasting;

use App\Models\Student;

class Notification
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\Student  $user
     * @return array|bool
     */
    public function join(Student $user)
    {
        //
    }
}
