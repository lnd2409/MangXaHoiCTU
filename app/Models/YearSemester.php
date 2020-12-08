<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class YearSemester
 * 
 * @property int $semester_id
 * @property int $school_year_id
 * 
 * @property SchoolYear $school_year
 * @property Semester $semester
 *
 * @package App\Models
 */
class YearSemester extends Model
{
	protected $table = 'year_semesters';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'semester_id' => 'int',
		'school_year_id' => 'int'
	];

	public function school_year()
	{
		return $this->belongsTo(SchoolYear::class);
	}

	public function semester()
	{
		return $this->belongsTo(Semester::class);
	}
}
