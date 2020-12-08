<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Like
 * 
 * @property int $com_id
 * @property int $stu_id
 * 
 * @property Comment $comment
 * @property Student $student
 *
 * @package App\Models
 */
class Like extends Model
{
	protected $table = 'likes';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'com_id' => 'int',
		'stu_id' => 'int'
	];

	public function comment()
	{
		return $this->belongsTo(Comment::class, 'com_id');
	}

	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}
}
