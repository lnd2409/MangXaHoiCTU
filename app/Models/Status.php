<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 * 
 * @property int $s_id
 * @property string $s_status
 * @property string $s_content
 * @property Carbon $s_created
 * @property int $ad_id
 * @property int $ub_id
 * @property int $uo_id
 * @property int $c_id
 * 
 * @property Admin $admin
 * @property Club $club
 * @property UnionBranch $union_branch
 * @property UnionOrganization $union_organization
 *
 * @package App\Models
 */
class Status extends Model
{
	protected $table = 'statuses';
	protected $primaryKey = 's_id';
	public $timestamps = false;

	protected $casts = [
		'ad_id' => 'int',
		'ub_id' => 'int',
		'uo_id' => 'int',
		'c_id' => 'int'
	];

	protected $dates = [
		's_created'
	];

	protected $fillable = [
		's_status',
		's_content',
		's_created',
		'ad_id',
		'ub_id',
		'uo_id',
		'c_id'
	];

	public function admin()
	{
		return $this->belongsTo(Admin::class, 'ad_id');
	}

	public function club()
	{
		return $this->belongsTo(Club::class, 'c_id');
	}

	public function union_branch()
	{
		return $this->belongsTo(UnionBranch::class, 'ub_id');
	}

	public function union_organization()
	{
		return $this->belongsTo(UnionOrganization::class, 'uo_id');
	}
}
