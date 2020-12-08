<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * 
 * @property int $noti_id
 * @property string $noti_content
 * @property bool $noti_status
 * @property Carbon $noti_created
 * @property int $stu_id
 * 
 * @property Student $student
 *
 * @package App\Models
 */
class Notification extends Model
{
	protected $table = 'notifications';
	protected $primaryKey = 'noti_id';
	public $timestamps = false;

	protected $casts = [
		'noti_status' => 'bool',
		'stu_id' => 'int'
	];

	protected $dates = [
		'noti_created'
	];

	protected $fillable = [
		'noti_content',
		'noti_status',
		'noti_created',
		'stu_id'
	];

	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}
}
