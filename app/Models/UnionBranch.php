<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UnionBranch
 * 
 * @property int $ub_id
 * @property string $ub_name
 * @property string $ub_slug
 * @property int $uo_id
 * 
 * @property UnionOrganization $union_organization
 * @property Collection|BranchBanner[] $branch_banners
 * @property Collection|Status[] $statuses
 * @property Collection|StudentsUb[] $students_ubs
 * @property Collection|UnionPost[] $union_posts
 *
 * @package App\Models
 */
class UnionBranch extends Model
{
	protected $table = 'union_branchs';
	protected $primaryKey = 'ub_id';
	public $timestamps = false;

	protected $casts = [
		'uo_id' => 'int'
	];

	protected $fillable = [
		'ub_name',
		'ub_slug',
		'uo_id'
	];

	public function union_organization()
	{
		return $this->belongsTo(UnionOrganization::class, 'uo_id');
	}

	public function branch_banners()
	{
		return $this->hasMany(BranchBanner::class, 'ub_id');
	}

	public function statuses()
	{
		return $this->hasMany(Status::class, 'ub_id');
	}

	public function students_ubs()
	{
		return $this->hasMany(StudentsUb::class, 'ub_id');
	}

	public function union_posts()
	{
		return $this->hasMany(UnionPost::class, 'ub_id');
	}
}
