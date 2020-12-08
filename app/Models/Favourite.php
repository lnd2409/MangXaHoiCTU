<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Favourite
 * 
 * @property int $stu_id
 * @property int $fo_id
 * 
 * @property Folder $folder
 * @property Student $student
 *
 * @package App\Models
 */
class Favourite extends Model
{
	protected $table = 'favourites';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'stu_id' => 'int',
		'fo_id' => 'int'
	];

	public function folder()
	{
		return $this->belongsTo(Folder::class, 'fo_id');
	}

	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}
}
