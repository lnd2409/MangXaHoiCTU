<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class IrReason
 * 
 * @property int $reason_id
 * @property int $ir_id
 * 
 * @property ItemReport $item_report
 * @property Reason $reason
 *
 * @package App\Models
 */
class IrReason extends Model
{
	protected $table = 'ir_reasons';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'reason_id' => 'int',
		'ir_id' => 'int'
	];

	public function item_report()
	{
		return $this->belongsTo(ItemReport::class, 'ir_id');
	}

	public function reason()
	{
		return $this->belongsTo(Reason::class);
	}
}
