<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ClubStudent
 * 
 * @property string $cs_role
 * @property Carbon $cs_created
 * @property int $stu_id
 * @property int $c_id
 * 
 * @property Club $club
 * @property Student $student
 *
 * @package App\Models
 */
class ClubStudent extends Model
{
	protected $table = 'club_students';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'stu_id' => 'int',
		'c_id' => 'int'
	];

	protected $dates = [
		'cs_created'
	];

	protected $fillable = [
		'cs_role',
		'cs_created'
	];

	public function club()
	{
		return $this->belongsTo(Club::class, 'c_id');
	}

	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}
}
