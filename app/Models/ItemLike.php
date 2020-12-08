<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemLike
 * 
 * @property int $item_id
 * @property int $stu_id
 * 
 * @property Item $item
 * @property Student $student
 *
 * @package App\Models
 */
class ItemLike extends Model
{
	protected $table = 'item_likes';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'item_id' => 'int',
		'stu_id' => 'int'
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
