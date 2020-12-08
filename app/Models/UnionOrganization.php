<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UnionOrganization
 * 
 * @property int $uo_id
 * @property string $uo_name
 * @property string $uo_slug
 * 
 * @property Collection|OrganizationBanner[] $organization_banners
 * @property Collection|Status[] $statuses
 * @property Collection|UnionBranch[] $union_branches
 *
 * @package App\Models
 */
class UnionOrganization extends Model
{
	protected $table = 'union_organizations';
	protected $primaryKey = 'uo_id';
	public $timestamps = false;

	protected $fillable = [
		'uo_name',
		'uo_slug'
	];

	public function organization_banners()
	{
		return $this->hasMany(OrganizationBanner::class, 'uo_id');
	}

	public function statuses()
	{
		return $this->hasMany(Status::class, 'uo_id');
	}

	public function union_branches()
	{
		return $this->hasMany(UnionBranch::class, 'uo_id');
	}
}
