<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Semester
 * 
 * @property int $semester_id
 * @property string $semester_name
 * 
 * @property Collection|Subject[] $subjects
 * @property Collection|YearSemester[] $year_semesters
 *
 * @package App\Models
 */
class Semester extends Model
{
	protected $table = 'semesters';
	protected $primaryKey = 'semester_id';
	public $timestamps = false;

	protected $fillable = [
		'semester_name'
	];

	public function subjects()
	{
		return $this->hasMany(Subject::class);
	}

	public function year_semesters()
	{
		return $this->hasMany(YearSemester::class);
	}
}
