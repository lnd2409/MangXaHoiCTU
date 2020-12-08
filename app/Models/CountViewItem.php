<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CountViewItem
 * 
 * @property int $stu_id
 * @property int $item_id
 * 
 * @property Item $item
 * @property Student $student
 *
 * @package App\Models
 */
class CountViewItem extends Model
{
	protected $table = 'count_view_items';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'stu_id' => 'int',
		'item_id' => 'int'
	];

	public function item()
	{
		return $this->belongsTo(Item::class);
	}

	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}
}
