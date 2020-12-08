<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 * 
 * @property int $course_id
 * @property string $course_name
 * 
 * @property Collection|YouthBranch[] $youth_branches
 *
 * @package App\Models
 */
class Course extends Model
{
	protected $table = 'courses';
	protected $primaryKey = 'course_id';
	public $timestamps = false;

	protected $fillable = [
		'course_name'
	];

	public function youth_branches()
	{
		return $this->hasMany(YouthBranch::class);
	}
}
