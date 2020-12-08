<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Folder
 * 
 * @property int $fo_id
 * @property string $fo_slug
 * @property string $fo_name
 * @property string $fo_permission
 * @property int $sub_id
 * @property int $stu_id
 * @property int $fo_child
 * 
 * @property Folder $folder
 * @property Student $student
 * @property Subject $subject
 * @property Collection|Favourite[] $favourites
 * @property Collection|File[] $files
 * @property Collection|Folder[] $folders
 *
 * @package App\Models
 */
class Folder extends Model
{
	protected $table = 'folders';
	protected $primaryKey = 'fo_id';
	public $timestamps = false;

	protected $casts = [
		'sub_id' => 'int',
		'stu_id' => 'int',
		'fo_child' => 'int'
	];

	protected $fillable = [
		'fo_slug',
		'fo_name',
		'fo_permission',
		'sub_id',
		'stu_id',
		'fo_child'
	];

	public function folder()
	{
		return $this->belongsTo(Folder::class, 'fo_child');
	}

	public function student()
	{
		return $this->belongsTo(Student::class, 'stu_id');
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class, 'sub_id');
	}

	public function favourites()
	{
		return $this->hasMany(Favourite::class, 'fo_id');
	}

	public function files()
	{
		return $this->hasMany(File::class, 'fo_id');
	}

	public function folders()
	{
		return $this->hasMany(Folder::class, 'fo_child');
	}
}
