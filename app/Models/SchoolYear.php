<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SchoolYear
 * 
 * @property int $school_year_id
 * @property string $school_year_name
 * 
 * @property Collection|Subject[] $subjects
 * @property Collection|YearSemester[] $year_semesters
 *
 * @package App\Models
 */
class SchoolYear extends Model
{
	protected $table = 'school_years';
	protected $primaryKey = 'school_year_id';
	public $timestamps = false;

	protected $fillable = [
		'school_year_name'
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
