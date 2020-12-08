<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subject
 * 
 * @property int $sub_id
 * @property string $sub_code
 * @property string $sub_name
 * @property int $semester_id
 * @property int $school_year_id
 * 
 * @property SchoolYear $school_year
 * @property Semester $semester
 * @property Collection|Folder[] $folders
 * @property Collection|Post[] $posts
 *
 * @package App\Models
 */
class Subject extends Model
{
	protected $table = 'subjects';
	protected $primaryKey = 'sub_id';
	public $timestamps = false;

	protected $casts = [
		'semester_id' => 'int',
		'school_year_id' => 'int'
	];

	protected $fillable = [
		'sub_code',
		'sub_name',
		'semester_id',
		'school_year_id'
	];

	public function school_year()
	{
		return $this->belongsTo(SchoolYear::class);
	}

	public function semester()
	{
		return $this->belongsTo(Semester::class);
	}

	public function folders()
	{
		return $this->hasMany(Folder::class, 'sub_id');
	}

	public function posts()
	{
		return $this->hasMany(Post::class, 'sub_id');
	}
}
