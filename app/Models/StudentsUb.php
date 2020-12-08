<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentsUb
 * 
 * @property string $sub_status
 * @property string $sub_role
 * @property Carbon $sub_created
 * @property Carbon $sub_deleted
 * @property int $stu_id
 * @property int $ub_id
 * 
 * @property Student $student
 * @property UnionBranch $union_branch
 *
 * @package App\Models
 */
class StudentsUb extends Model
{
	protected $table = 'students_ub';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'stu_id' => 'int',
		'ub_id' => 'int'
	];

	protected $dates = [
		'sub_created',
		'sub_deleted'
	];

	protected $fillable = [
		'sub_status',
		'sub_role',
		'sub_created',
		'sub_deleted'
	];

	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}

	public function union_branch()
	{
		return $this->belongsTo(UnionBranch::class, 'ub_id');
	}
}
