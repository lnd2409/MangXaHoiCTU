<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CountViewPost
 * 
 * @property int $stu_id
 * @property int $p_id
 * 
 * @property Post $post
 * @property Student $student
 *
 * @package App\Models
 */
class CountViewPost extends Model
{
	protected $table = 'count_view_posts';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'stu_id' => 'int',
		'p_id' => 'int'
	];

	public function post()
	{
		return $this->belongsTo(Post::class, 'p_id');
	}

	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}
}
