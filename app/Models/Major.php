<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Major
 * 
 * @property int $major_id
 * @property string $major_name
 * @property int $academy_id
 * 
 * @property Academy $academy
 * @property Collection|YouthBranch[] $youth_branches
 *
 * @package App\Models
 */
class Major extends Model
{
	protected $table = 'majors';
	protected $primaryKey = 'major_id';
	public $timestamps = false;

	protected $casts = [
		'academy_id' => 'int'
	];

	protected $fillable = [
		'major_name',
		'academy_id'
	];

	public function academy()
	{
		return $this->belongsTo(Academy::class);
	}

	public function youth_branches()
	{
		return $this->hasMany(YouthBranch::class);
	}
}
