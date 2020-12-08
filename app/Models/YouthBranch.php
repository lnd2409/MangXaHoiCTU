<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class YouthBranch
 *
 * @property int $yb_id
 * @property string $yb_name
 * @property int $course_id
 * @property int $major_id
 *
 * @property Course $course
 * @property Major $major
 * @property Collection|Student[] $students
 *
 * @package App\Models
 */
class YouthBranch extends Model
{
	protected $table = 'youth_branchs';
	protected $primaryKey = 'yb_id';
	public $timestamps = false;

	protected $casts = [
		'course_id' => 'int',
		'major_id' => 'int'
	];

	protected $fillable = [
		'yb_name',
		'course_id',
		'major_id'
	];

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function major()
	{
		return $this->belongsTo(Major::class);
	}

	public function students()
	{
		return $this->hasMany(Student::class, 'yb_id');
	}
}
