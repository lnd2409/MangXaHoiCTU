<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BranchBanner
 * 
 * @property int $bb_id
 * @property string $bb_path
 * @property int $ub_id
 * 
 * @property UnionBranch $union_branch
 *
 * @package App\Models
 */
class BranchBanner extends Model
{
	protected $table = 'branch_banners';
	protected $primaryKey = 'bb_id';
	public $timestamps = false;

	protected $casts = [
		'ub_id' => 'int'
	];

	protected $fillable = [
		'bb_path',
		'ub_id'
	];

	public function union_branch()
	{
		return $this->belongsTo(UnionBranch::class, 'ub_id');
	}
}
