<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Type
 * 
 * @property int $type_id
 * @property string $type_name
 * @property string $type_slug
 * 
 * @property Collection|Item[] $items
 *
 * @package App\Models
 */
class Type extends Model
{
	protected $table = 'types';
	protected $primaryKey = 'type_id';
	public $timestamps = false;

	protected $fillable = [
		'type_name',
		'type_slug'
	];

	public function items()
	{
		return $this->hasMany(Item::class);
	}
}
