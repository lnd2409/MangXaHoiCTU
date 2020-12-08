<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class File
 * 
 * @property int $f_id
 * @property string $f_name
 * @property string $f_size
 * @property string $f_path
 * @property Carbon $f_created
 * @property Carbon $f_updated
 * @property Carbon $f_deleted
 * @property int $fo_id
 * 
 * @property Folder $folder
 *
 * @package App\Models
 */
class File extends Model
{
	protected $table = 'files';
	protected $primaryKey = 'f_id';
	public $timestamps = false;

	protected $casts = [
		'fo_id' => 'int'
	];

	protected $dates = [
		'f_created',
		'f_updated',
		'f_deleted'
	];

	protected $fillable = [
		'f_name',
		'f_size',
		'f_path',
		'f_created',
		'f_updated',
		'f_deleted',
		'fo_id'
	];

	public function folder()
	{
		return $this->belongsTo(Folder::class, 'fo_id');
	}
}
