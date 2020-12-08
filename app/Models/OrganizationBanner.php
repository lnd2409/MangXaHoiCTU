<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrganizationBanner
 * 
 * @property int $ob_id
 * @property string $ob_path
 * @property int $uo_id
 * 
 * @property UnionOrganization $union_organization
 *
 * @package App\Models
 */
class OrganizationBanner extends Model
{
	protected $table = 'organization_banners';
	protected $primaryKey = 'ob_id';
	public $timestamps = false;

	protected $casts = [
		'uo_id' => 'int'
	];

	protected $fillable = [
		'ob_path',
		'uo_id'
	];

	public function union_organization()
	{
		return $this->belongsTo(UnionOrganization::class, 'uo_id');
	}
}
