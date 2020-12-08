<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * 
 * @property int $com_id
 * @property string $com_content
 * @property Carbon $com_created
 * @property int $p_id
 * 
 * @property Post $post
 * @property Collection|Like[] $likes
 * @property Collection|Report[] $reports
 *
 * @package App\Models
 */
class Comment extends Model
{
	protected $table = 'comments';
	protected $primaryKey = 'com_id';
	public $timestamps = false;

	protected $casts = [
		'p_id' => 'int',
		'stu_id'=>'int'
	];

	protected $dates = [
		'com_created'
	];

	protected $fillable = [
		'com_content',
		'com_created',
		'p_id',
		'stu_id'
	];

	public function post()
	{
		return $this->belongsTo(Post::class, 'p_id');
	}

	public function likes()
	{
		return $this->hasMany(Like::class, 'com_id');
	}

	public function reports()
	{
		return $this->hasMany(Report::class, 'com_id');
	}
	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}
}
