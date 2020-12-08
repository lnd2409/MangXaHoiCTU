<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * 
 * @property int $image_id
 * @property string $image_path
 * @property int $item_id
 * 
 * @property Item $item
 *
 * @package App\Models
 */
class Image extends Model
{
	protected $table = 'images';
	protected $primaryKey = 'image_id';
	public $timestamps = false;

	protected $casts = [
		'item_id' => 'int'
	];

	protected $fillable = [
		'image_path',
		'item_id'
	];

	public function item()
	{
		return $this->belongsTo(Item::class);
	}
}
