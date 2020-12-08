<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentsUo
 * 
 * @property string $suo_status
 * @property string $suo_role
 * @property Carbon $suo_created
 * @property Carbon $suo_deleted
 * @property int $stu_id
 * @property int $uo_id
 * 
 * @property Student $student
 * @property UnionOrganization $union_organization
 *
 * @package App\Models
 */
class StudentsUo extends Model
{
	protected $table = 'students_uo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'stu_id' => 'int',
		'uo_id' => 'int'
	];

	protected $dates = [
		'suo_created',
		'suo_deleted'
	];

	protected $fillable = [
		'suo_status',
		'suo_role',
		'suo_created',
		'suo_deleted'
	];

	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}

	public function union_organization()
	{
		return $this->belongsTo(UnionOrganization::class, 'uo_id');
	}
}
