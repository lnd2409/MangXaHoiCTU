<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Student
 *
 * @property int $stu_id
 * @property string $username
 * @property string $password
 * @property string $remember_token
 * @property string $stu_avatar
 * @property string $stu_name
 * @property string $stu_birth
 * @property string $stu_code
 * @property string $stu_address
 * @property string $stu_gmail
 * @property int $yb_id
 *
 * @property YouthBranch $youth_branch
 * @property Collection|ClubPost[] $club_posts
 * @property Collection|Club[] $clubs
 * @property Collection|Favourite[] $favourites
 * @property Collection|Folder[] $folders
 * @property Collection|Item[] $items
 * @property Collection|Like[] $likes
 * @property Collection|Notification[] $notifications
 * @property Collection|Post[] $posts
 * @property Collection|Report[] $reports
 * @property Collection|StudentsUb[] $students_ubs
 * @property Collection|UnionPost[] $union_posts
 *
 * @package App\Models
 */
class Student extends Authenticatable
{
	protected $table = 'students';
	protected $primaryKey = 'stu_id';
	public $timestamps = false;

	protected $casts = [
		'yb_id' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'username',
		'password',
		'remember_token',
		'stu_avatar',
		'stu_name',
		'stu_birth',
		'stu_code',
		'stu_address',
		'stu_gmail',
		'yb_id'
	];

	public function youth_branch()
	{
		return $this->belongsTo(YouthBranch::class, 'yb_id');
	}

	public function club_posts()
	{
		return $this->hasMany(ClubPost::class, 'stu_id');
	}

	public function clubs()
	{
		return $this->belongsToMany(Club::class, 'club_students', 'stu_id', 'c_id')
					->withPivot('cs_role', 'cs_created');
	}
	public function club_students()
	{
		return $this->hasMany(ClubStudent::class, 'stu_id');
	}

	public function count_view_clubs()
	{
		return $this->hasMany(CountViewClub::class, 'stu_id');
	}

	public function count_view_items()
	{
		return $this->hasMany(CountViewItem::class, 'stu_id');
	}

	public function count_view_posts()
	{
		return $this->hasMany(CountViewPost::class, 'stu_id');
	}

	public function count_view_unions()
	{
		return $this->hasMany(CountViewUnion::class, 'stu_id');
	}

	public function favourites()
	{
		return $this->hasMany(Favourite::class, 'stu_id');
	}

	public function item_likes()
	{
		return $this->hasMany(ItemLike::class, 'stu_id');
	}

	public function item_reports()
	{
		return $this->hasMany(ItemReport::class, 'stu_id');
	}

	public function items()
	{
		return $this->hasMany(Item::class, 'stu_id');
	}

	public function likes()
	{
		return $this->hasMany(Like::class, 'stu_id');
	}

	public function notifications()
	{
		return $this->hasMany(Notification::class, 'stu_id');
	}

	public function posts()
	{
		return $this->hasMany(Post::class, 'stu_id');
	}

	public function reports()
	{
		return $this->hasMany(Report::class, 'stu_id');
	}

	public function students_ubs()
	{
		return $this->hasMany(StudentsUb::class, 'stu_id');
	}

	public function students_uos()
	{
		return $this->hasMany(StudentsUo::class, 'stu_id');
	}

	public function subjects()
	{
		return $this->belongsToMany(Subject::class, 'subjects_student', 'stu_id', 'sub_id');
	}

	public function union_posts()
	{
		return $this->hasMany(UnionPost::class, 'stu_id');
	}

	public function message() {
        return $this->hasMany(Messsage::class,'mess_id');
    }
}
