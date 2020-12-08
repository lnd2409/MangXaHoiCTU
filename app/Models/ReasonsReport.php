<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReasonsReport
 * 
 * @property int $reason_id
 * @property int $r_id
 * 
 * @property Report $report
 * @property Reason $reason
 *
 * @package App\Models
 */
class ReasonsReport extends Model
{
	protected $table = 'reasons_report';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'reason_id' => 'int',
		'r_id' => 'int'
	];

	public function report()
	{
		return $this->belongsTo(Report::class, 'r_id');
	}

	public function reason()
	{
		return $this->belongsTo(Reason::class);
	}
}
