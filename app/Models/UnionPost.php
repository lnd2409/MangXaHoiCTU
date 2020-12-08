<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UnionPost
 * 
 * @property int $up_id
 * @property string $up_slug
 * @property string $up_avatar
 * @property string $up_title
 * @property string $up_content
 * @property int $up_view_count
 * @property Carbon $up_created
 * @property int $stu_id
 * @property int $ub_id
 * 
 * @property Student $student
 * @property UnionBranch $union_branch
 *
 * @package App\Models
 */
class UnionPost extends Model
{
	protected $table = 'union_posts';
	protected $primaryKey = 'up_id';
	public $timestamps = false;

	protected $casts = [
		'up_view_count' => 'int',
		'stu_id' => 'int',
		'ub_id' => 'int'
	];

	protected $dates = [
		'up_created'
	];

	protected $fillable = [
		'up_slug',
		'up_avatar',
		'up_title',
		'up_content',
		'up_view_count',
		'up_created',
		'stu_id',
		'ub_id'
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
