<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 *
 * @property int $item_id
 * @property string $item_name
 * @property string $item_price
 * @property string $item_phone
 * @property string $item_title
 * @property string $item_content
 * @property string $item_slug
 * @property string $item_view_count
 * @property string $item_avatar
 * @property Carbon $item_created
 * @property Carbon $item_deleted
 * @property int $stu_id
 * @property int $type_id
 *
 * @property Student $student
 * @property Type $type
 * @property Collection|Image[] $images
 *
 * @package App\Models
 */
class Item extends Model
{
	protected $table = 'items';
	protected $primaryKey = 'item_id';
	public $timestamps = false;

	protected $casts = [
		'stu_id' => 'int',
		'type_id' => 'int'
	];

	protected $dates = [
		'item_created',
		'item_deleted'
	];

	protected $fillable = [
		'item_name',
		'item_price',
		'item_phone',
		'item_title',
		'item_content',
		'item_slug',
		'item_view_count',
		'item_avatar',
		'item_created',
		'item_deleted',
		'stu_id',
		'type_id'
	];

	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}

	public function type()
	{
		return $this->belongsTo(Type::class);
	}

	public function count_view_items()
	{
		return $this->hasMany(CountViewItem::class);
	}

	public function images()
	{
		return $this->hasMany(Image::class);
	}
}
