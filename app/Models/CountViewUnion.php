<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CountViewUnion
 * 
 * @property int $stu_id
 * @property int $up_id
 * 
 * @property Student $student
 * @property UnionPost $union_post
 *
 * @package App\Models
 */
class CountViewUnion extends Model
{
	protected $table = 'count_view_unions';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'stu_id' => 'int',
		'up_id' => 'int'
	];

	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}

	public function union_post()
	{
		return $this->belongsTo(UnionPost::class, 'up_id');
	}
}
