<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Admin
 * 
 * @property int $ad_id
 * @property string $username
 * @property string $password
 * @property string $ad_name
 * 
 * @property Collection|Status[] $statuses
 *
 * @package App\Models
 */
class Admin extends Authenticatable
{
	protected $table = 'admins';
	protected $primaryKey = 'ad_id';
	public $timestamps = false;

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'password',
		'ad_name'
	];

	public function statuses()
	{
		return $this->hasMany(Status::class, 'ad_id');
	}
}
