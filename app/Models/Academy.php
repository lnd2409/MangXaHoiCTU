<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Academy
 * 
 * @property int $academy_id
 * @property string $academy_name
 * 
 * @property Collection|Major[] $majors
 *
 * @package App\Models
 */
class Academy extends Model
{
	protected $table = 'academies';
	protected $primaryKey = 'academy_id';
	public $timestamps = false;

	protected $fillable = [
		'academy_name'
	];

	public function majors()
	{
		return $this->hasMany(Major::class);
	}
}
