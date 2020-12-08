<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reason
 * 
 * @property int $reason_id
 * @property string $reason_content
 * 
 * @property Collection|Report[] $reports
 *
 * @package App\Models
 */
class Reason extends Model
{
	protected $table = 'reasons';
	protected $primaryKey = 'reason_id';
	public $timestamps = false;

	protected $fillable = [
		'reason_content'
	];

	public function reports()
	{
		return $this->belongsToMany(Report::class, 'reasons_report', 'reason_id', 'r_id');
	}
}
