<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CountViewClub
 * 
 * @property int $stu_id
 * @property int $cp_id
 * 
 * @property ClubPost $club_post
 * @property Student $student
 *
 * @package App\Models
 */
class CountViewClub extends Model
{
	protected $table = 'count_view_clubs';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'stu_id' => 'int',
		'cp_id' => 'int'
	];

	public function club_post()
	{
		return $this->belongsTo(ClubPost::class, 'cp_id');
	}

	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}
}
