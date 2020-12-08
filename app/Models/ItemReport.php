<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemReport
 * 
 * @property int $ir_id
 * @property int $item_id
 * @property int $stu_id
 * 
 * @property Item $item
 * @property Student $student
 * @property Collection|IrReason[] $ir_reasons
 *
 * @package App\Models
 */
class ItemReport extends Model
{
	protected $table = 'item_reports';
	protected $primaryKey = 'ir_id';
	public $timestamps = false;

	protected $casts = [
		'item_id' => 'int',
		'stu_id' => 'int'
	];

	protected $fillable = [
		'item_id',
		'stu_id'
	];

	public function item()
	{
		return $this->belongsTo(Item::class);
	}

	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}

	public function ir_reasons()
	{
		return $this->hasMany(IrReason::class, 'ir_id');
	}
}
