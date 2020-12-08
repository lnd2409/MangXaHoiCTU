<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ClubPost
 * 
 * @property int $cp_id
 * @property string $cp_slug
 * @property string $cp_avatar
 * @property string $cp_title
 * @property string $cp_content
 * @property string $cp_view_count
 * @property Carbon $cp_created
 * @property int $stu_id
 * @property int $c_id
 * 
 * @property Club $club
 * @property Student $student
 *
 * @package App\Models
 */
class ClubPost extends Model
{
	protected $table = 'club_posts';
	protected $primaryKey = 'cp_id';
	public $timestamps = false;

	protected $casts = [
		'stu_id' => 'int',
		'c_id' => 'int'
	];

	protected $dates = [
		'cp_created'
	];

	protected $fillable = [
		'cp_slug',
		'cp_avatar',
		'cp_title',
		'cp_content',
		'cp_view_count',
		'cp_created',
		'stu_id',
		'c_id'
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
