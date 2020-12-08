<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 * 
 * @property int $r_id
 * @property int $com_id
 * @property int $stu_id
 * 
 * @property Comment $comment
 * @property Student $student
 * @property Collection|Reason[] $reasons
 *
 * @package App\Models
 */
class Report extends Model
{
	protected $table = 'reports';
	protected $primaryKey = 'r_id';
	public $timestamps = false;

	protected $casts = [
		'com_id' => 'int',
		'stu_id' => 'int'
	];

	protected $fillable = [
		'com_id',
		'stu_id'
	];

	public function comment()
	{
		return $this->belongsTo(Comment::class, 'com_id');
	}

	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}

	public function reasons()
	{
		return $this->belongsToMany(Reason::class, 'reasons_report', 'r_id');
	}
}
