<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubjectsStudent
 * 
 * @property int $sub_id
 * @property int $stu_id
 * 
 * @property Student $student
 * @property Subject $subject
 * @property Collection|Folder[] $folders
 *
 * @package App\Models
 */
class SubjectsStudent extends Model
{
	protected $table = 'subjects_student';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'sub_id' => 'int',
		'stu_id' => 'int'
	];

	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class, 'sub_id');
	}

	public function folders()
	{
		return $this->hasMany(Folder::class, 'sub_id');
	}
}
