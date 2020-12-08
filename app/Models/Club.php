<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Club
 * 
 * @property int $c_id
 * @property string $c_slug
 * @property string $c_name
 * 
 * @property Collection|ClubPost[] $club_posts
 * @property Collection|Student[] $students
 * @property Collection|Status[] $statuses
 *
 * @package App\Models
 */
class Club extends Model
{
	protected $table = 'clubs';
	protected $primaryKey = 'c_id';
	public $timestamps = false;

	protected $fillable = [
		'c_slug',
		'c_name'
	];

	public function club_posts()
	{
		return $this->hasMany(ClubPost::class, 'c_id');
	}

	public function students()
	{
		return $this->belongsToMany(Student::class, 'club_students', 'c_id', 'stu_id')
					->withPivot('cs_role', 'cs_created');
	}

	public function statuses()
	{
		return $this->hasMany(Status::class, 'c_id');
	}
}
